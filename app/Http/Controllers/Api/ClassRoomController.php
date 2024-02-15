<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClassRoomStoreRequest;
use App\Http\Resources\Api\ClassRoomResource;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClassRoomController extends Controller
{
    public function index(Request $request)
    {
        $classRoom = ClassRoom::all();

        return new ClassRoomResource($classRoom);
    }

    public function show(Request $request, $id)
    {
        $classRoom = ClassRoom::find($id);

        return new ClassRoomResource($classRoom);
    }

    public function store(ClassRoomStoreRequest $request): Response
    {
        $classRoom = ClassRoom::create($request->validated());

        return response()->noContent(201);
    }
}
