<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StudentStoreRequest;
use App\Http\Requests\Api\UserAuthRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $token = $student->createToken('Api token of '. $student->name)->plainTextToken;

        if (!$student || ! Hash::check($request->password , $student->password)) {
            return response()->json(['Credentials do not match'],401); 
        }else{
            return response()->json([
                $student,
                $token,
            ],200); 
        }
    }
    
    
}
