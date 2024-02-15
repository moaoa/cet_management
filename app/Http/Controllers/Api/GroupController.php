<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GroupStoreRequest;
use App\Http\Resources\Api\GroupResource;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $groups = Group::all();

        return new GroupResource($groups);
    }

    public function show(Request $request, Group $id)
    {
        $group = Group::find($id);

        return new GroupResource($group);
    }

    public function store(GroupStoreRequest $request)
    {
        $group = Group::create($request->validated());

        return response()->noContent(201);
    }
}
