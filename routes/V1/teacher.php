<?php

use App\Http\Controllers\Api\TeacherController;
use Illuminate\Support\Facades\Route;


//public
Route::post('/login',[TeacherController::class,'login']);
Route::post('/register',[TeacherController::class,'store']);


//protected
Route::middleware('auth:sanctum')->get('/showAll',[TeacherController::class,'index']);
Route::middleware('auth:sanctum')->get('/show/{id}',[TeacherController::class,'show']);
