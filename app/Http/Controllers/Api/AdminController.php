<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Http\Requests\Api\UserAuthRequest;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function store(UserAuthRequest $request)
    {
        $request->validated($request->all());

        $admin = Admin::create([
            'ref_number'=> $request->ref_number,
            'password'=>Hash::make($request->password),
        ]);

        $token = $admin->createToken('Api token of '. $admin->name)->plainTextToken;
        
        return response()->json([
            $admin,
            'token'=>$token,
        ]);
    }

    public function login(UserAuthRequest $request)
    {
        $request->validated($request->all());
        $admin = Admin::where('ref_number',$request->ref_number)->first();

        if (!$admin || ! Hash::check($request->password , $admin->password)) {
            return response()->json(['Credentials do not match'],401); 
        }else{
            
            $token = $admin->createToken('Api token of '. $admin->name)->plainTextToken;
            return response()->json([
                $admin,
                $token,
            ],200); 
        }
    }
    public function createStudent(UserAuthRequest $request)
    {
        $request->validated($request->all());

        Student::create([
            'ref_number' => $request->ref_number,
            'password' => Hash::make($request->password),
        ]);

        // $token = $student->createToken('Api token of '. $student->name)->plainTextToken;
        
        // return response()->json([
        //     $student,
        //     'token'=>$token,
        // ]);

        return response()->json([
            'message' => 'تم إضافة طالب بنجاح'
        ]);
    }
    public function createTeacher(UserAuthRequest $request)
    {
        $request->validated($request->all());

        Teacher::create([
            'ref_number' => $request->ref_number,
            'password' => Hash::make($request->password),
        ]);

        // $token = $student->createToken('Api token of '. $student->name)->plainTextToken;
        
        // return response()->json([
        //     $student,
        //     'token'=>$token,
        // ]);

        return response()->json([
            'message' => 'تم إضافة استاذ بنجاح'
        ]);
    }
    public function assignSubjectToTeacher(Request $request)
    {
       $data = $request->validate([
        'teacher_id' => 'required|exists:teachers,id',
        'subject_id' => 'required|exists:subjects,id'
       ]);

       if(!$data){
         return 'your input is not valid';
       }

       try {
          //code...
          $teacher = Teacher::where('id', $request->teacher_id)->first();

          $teacherAlreadyHasTheSubject = $teacher->subjects()->where('subject_id', $request->subject_id)->exists();

          if(!$teacherAlreadyHasTheSubject){
            $teacher->subjects()->attach($request->subject_id);

            $teacher->save();
          } else {
            return 'teacher already has this subject';
          }

          return 'subject was assigned to teacher';
       } catch (\Throwable $th) {
        //throw $th;
        return $th;
       }
    }
    public function assignStudentToSemester(Request $request){
       $data = $request->validate([
        'semester_id' => 'required|exists:semesters,id',
        'student_id' => 'required|exists:students,id'
       ]);

       if(!$data){
        return 'الرجاء ادخال بيانات صحيحة';
       }

       $student = Student::find($request->student_id);
       $semester = Semester::find($request->semester_id);

       $subjectsInSemesterIds = $semester->subjects()->pluck('subjects.id');


       $student->subjects()->attach($subjectsInSemesterIds);

       return response()->json([
        'message' => 'تم إضافة مواد للطالب'
       ]);
    }
    
}
