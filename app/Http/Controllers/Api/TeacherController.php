<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TeacherStoreRequest;
use App\Http\Resources\Api\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $teachers = Teacher::all();

        return response()->json($teachers);
    }

    public function store(TeacherStoreRequest $request)
    {
        $teacher = Teacher::create($request->validated());

        return response()->json($teacher);
    }

    public function show(Request $request, $id)
    {
        $teacher = Teacher::find($id);

        return response()->json($teacher);
    }
}
