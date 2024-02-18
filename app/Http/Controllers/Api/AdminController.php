<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Http\Requests\Api\UserAuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function store(UserAuthRequest $request)
    {
        $request->validated($request->all());

        $admin = Admin::create([
            'ref_number'=> $request->ref_number,
            'password'=>Hash::make($request->password),
        ]);

        $token = $admin->createToken('Api token of '. $admin->name)->plainTextToken;
        
        return response()->json([
            $admin,
            'token'=>$token,
        ]);
    }

    public function login(UserAuthRequest $request)
    {
        $request->validated($request->all());
        $admin = Admin::where('ref_number',$request->ref_number)->first();

        if (!$admin || ! Hash::check($request->password , $admin->password)) {
            return response()->json(['Credentials do not match'],401); 
        }else{
            
            $token = $admin->createToken('Api token of '. $admin->name)->plainTextToken;
            return response()->json([
                $admin,
                $token,
            ],200); 
        }
    }
}
