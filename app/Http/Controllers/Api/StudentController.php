<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StudentStoreRequest;
use App\Http\Requests\Api\UserAuthRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $student = Student::create($request->validated());

        return response()->json($student);
    }

    public function show(Request $request, $id)
    {
        $student = Student::find($id);

        return response()->json($student);
    }
    // public function login(UserAuthRequest $request)
    // {
    //     $request->validated($request->all());

    //     if (!Auth::attempt([$request->only('ref_number','password')])) {
    //         return response()->json(['Credentials do not match'],401); 
    //     }
    // }
    
    
}
