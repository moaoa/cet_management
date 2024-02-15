<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SubjectStoreRequest;
use App\Http\Resources\Api\SubjectResource;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::all();

        return new SubjectResource($subjects);
    }

    public function show(Request $request,  $id)
    {
        $subject = Subject::find($id);

        return new SubjectResource($subject);
    }

    public function store(SubjectStoreRequest $request)
    {
        $subject = Subject::create($request->validated());

        return response()->noContent(201);
    }
}
