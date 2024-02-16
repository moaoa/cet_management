<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SemesterStoreRequest;
use App\Http\Resources\Api\SemesterResource;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SemesterController extends Controller
{
    public function index(Request $request)
    {
        $semesters = Semester::all();

        return  response()->json($semesters);
    }

    public function store(SemesterStoreRequest $request)
    {
        $semester = Semester::create($request->validated());

        return  response()->json($semester);
    }

    public function show(Request $request, $id)
    {
        $semester = Semester::find($id);

        return  response()->json($semester);
    }
}
