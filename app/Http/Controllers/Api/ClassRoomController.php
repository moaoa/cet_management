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
        $classRooms = ClassRoom::all();

        return response()->json($classRooms);
    }

    public function show(Request $request, $id)
    {
        $classRoom = ClassRoom::find($id);

        return response()->json($classRoom);
    }

    public function store(ClassRoomStoreRequest $request)
    {
        $classRoom = ClassRoom::create($request->validated());

        return response()->json($classRoom);
    }
}
