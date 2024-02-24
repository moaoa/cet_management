<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StudentStoreRequest;
use App\Http\Requests\Api\UserAuthRequest;
use App\Models\Lecture;
use App\Models\Lecture_Student;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::all();

        return response()->json($students);
    }

    public function store(StudentStoreRequest $request)
    {
        $request->validated($request->all());

        $student = Student::create([
            'name'=> $request->name,
            'ref_number'=> $request->ref_number,
            'password'=>Hash::make($request->password),
            'email'=> $request->email,
            'phone_number'=>$request->phone_number,
        ]);

        $token = $student->createToken('Api token of '. $student->name)->plainTextToken;

        return response()->json([
            $student,
            'token'=>$token,
        ]);
    }

    public function show(Request $request, $id)
    {
        $student = Student::find($id);

        return response()->json($student);
    }

    public function login(UserAuthRequest $request)
    {
        $request->validated($request->all());
        $student = Student::where('ref_number',$request->ref_number)->first();

        if (!$student || ! Hash::check($request->password , $student->password)) {
            return response()->json(['Credentials do not match'],401); 
        }else{
            
            $token = $student->createToken('Api token of '. $student->name)->plainTextToken;
            return response()->json([
                "id"=> $student->id,
                "name" => $student->name,
                "group" => $student->group_id,
                "ref_number"=>$student->ref_number,
                "email"=>$student->email,
                "phone_number"=>$student->phone_number,
                "token"=>$token,
            ],200); 
        }
    }

    public function LectureSchedules($student_id){

        $studentExists =Student::where('id',$student_id)->exists();

        if (!$studentExists) {
            # code...
            return 'لايوجد طالب بهذا الرقم';
        }

        $studentGroup = Student::where('id',$student_id)->value('group_id');
        
        $lectureRecords = DB::table('lectures')
        ->join('subjects', 'lectures.subject_id', '=', 'subjects.id')
        ->join('teachers', 'lectures.teacher_id', '=', 'teachers.id')
        ->join('class_rooms', 'lectures.class_room_id', '=', 'class_rooms.id')
        ->select(
            'lectures.start_time',
            'lectures.end_time',
            'lectures.day_of_week', 
            'subjects.name as subject_name', 
            'teachers.name as teacher_name',
            'class_rooms.name as class_room')
        ->where('lectures.group_id', $studentGroup)
        ->get();
         
        if ($lectureRecords->isEmpty()) {
            # code...
            return 'لاتوجد محاضرات لهذا الطالب';
        }
        return $lectureRecords;
    }
    
    public function updateStudent(Request $request)
    {
        $request->validate([
            // 'student_id'
        ]);
    }


    }
