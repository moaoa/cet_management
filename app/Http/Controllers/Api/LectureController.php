<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LectureStoreRequest;
use App\Http\Resources\Api\LectureResource;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LectureController extends Controller
{
    public function index(Request $request)
    {
        $lectures = Lecture::all();

        return new LectureResource($lectures);
    }

    public function show(Request $request, Lecture $id)
    {
        $lecture = Lecture::find($id);

        return new LectureResource($lecture);
    }

    public function store(LectureStoreRequest $request): Response
    {
        $lecture = Lecture::create($request->validated());

        return response()->noContent(201);
    }
}
