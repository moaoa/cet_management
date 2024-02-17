<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TeacherStoreRequest;
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
    
}
