<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TeacherStoreRequest;
use App\Http\Requests\Api\UserAuthRequest;
use App\Models\Lecture;
use App\Models\Lecture_Student;
use App\Models\Subject;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $teachers = Teacher::all();

        return response()->json($teachers);
    }

    public function store(TeacherStoreRequest $request)
    {
        $request->validated($request->all());

        $teacher = Teacher::create([
            'name'=> $request->name,
            'ref_number'=> $request->ref_number,
            'password'=>Hash::make($request->password),
            'email'=> $request->email,
            'phone_number'=>$request->phone_number,
        ]);

        $token = $teacher->createToken('Api token of '. $teacher->name)->plainTextToken;
        
        return response()->json([
            $teacher,
            'token'=>$token,
        ]);
    }

    public function show(Request $request, $id)
    {
        $teacher = Teacher::find($id);

        return response()->json($teacher);
    }

    public function login(UserAuthRequest $request)
    {
        $request->validated($request->all());
        $teacher = Teacher::where('ref_number',$request->ref_number)->first();

        if (!$teacher || ! Hash::check($request->password , $teacher->password)) {
            return response()->json(['Credentials do not match'],401); 
        }else{
            
            $token = $teacher->createToken('Api token of '. $teacher->name)->plainTextToken;
            return response()->json([
                $teacher,
                $token,
            ],200); 
        }
    }

    public function teacherWeeklyLectures (Request $request,$teacher_id)
    {

        $teacherExists = Teacher::where('id',$teacher_id)->exists();

        if (!$teacherExists) {
            # code...
            return ' لا يوجد استاذ بهذا الرقم';

        }else{
            try {
            
                $lectures = Lecture::where('teacher_id',$teacher_id)->orderBy('day_of_week','asc')->get();

                if (!$lectures->isEmpty()) {
                    # code...
                    return response()->json($lectures);
                    
                }else{
                    return 'لاتوجد محاضرات لهذا الاستاذ';
                }

            } catch (\Throwable $th) {
            //throw $th;
            return $th;
            }

        }
    }

    public function takeTheAttendence(Request $request)
    {
        try {
            //code...
            $request->validate([
                'lecture_id'=>'required|exists:lectures,id',
                'student_id' => 'required|exists:students,id',
                'status'=> ['required','integer','min:1','max:3 '],
                'note'=> ['nullable','string','max:255'],
            ]);

            $currentDate = Carbon::now()->toDateString();
            // $currentDateTime = new DataTime();
            // $formattedDate = $currentDateTime->format('Y-m-d H:i:s');
            // return response()->json([
            //      $currentDate
            // ]);
            
            $lecture_student = Lecture_Student::create([
                'lecture_id'=>$request->lecture_id,
                'student_id'=>$request->student_id,
                'status'=>$request->status,
                'note'=>$request->note,
                'date'=>$currentDate,
            ]);
    
        } catch (\Throwable $th) {
            //throw $th;
            return 'لقد تم تسجيل حضور هذا الطالب بالفعل';            
        }
       
        return 'تمت عملية تسجيل حضور الطالب بنجاح';


    }
    
    public function teacherSubjects($teacher_id)
    {
        try {
        
            $teacher =Teacher::where('id',$teacher_id)->first();
            
            if (!$teacher) {
                # code...
                return 'لايوجد استاذ بهذا الرقم';
            }
            
            $subjects = $teacher->subjects()->where('teacher_id',$teacher_id)->get();
            if ($subjects->isEmpty()) {
                # code...
                return 'الاستاذ لايدرس اي مادة';
            }

            return response()->json($subjects);
            
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
        
    }
}
