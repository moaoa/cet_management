<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StudentStoreRequest;
use App\Http\Resources\Api\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::all();

        return new StudentResource($students);
    }

    public function store(StudentStoreRequest $request): Response
    {
        $student = Student::create($request->validated());

        return response()->noContent(201);
    }

    public function show(Request $request, $id)
    {
        $student = Student::find($id);

        return new StudentResource($student);
    }
}
