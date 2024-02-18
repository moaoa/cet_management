<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TeacherStoreRequest;
use App\Http\Requests\Api\UserAuthRequest;
use App\Models\Lecture;
use App\Models\Teacher;
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
            return 'invalid teacher';

        }else{
            try {
            
                $lectures = Lecture::where('teacher_id',$teacher_id)->orderBy('day_of_week','asc')->get();

                if (!$lectures->isEmpty()) {
                    # code...
                    return response()->json($lectures);
                    
                }else{
                    return 'the teacher does not have leactures...';
                }

            } catch (\Throwable $th) {
            //throw $th;
            return $th;
            }

        }
        
    }
    
}
