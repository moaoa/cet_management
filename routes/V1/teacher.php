<?php

use App\Http\Controllers\Api\LectureController;
use App\Http\Controllers\Api\TeacherController;
use Illuminate\Support\Facades\Route;


//public
Route::post('/login',[TeacherController::class,'login']);
Route::post('/register',[TeacherController::class,'store']);


//protected
Route::middleware('auth:sanctum')->get('/showAll',[TeacherController::class,'index']);
Route::middleware('auth:sanctum')->get('/show/{id}',[TeacherController::class,'show']);
Route::middleware('auth:sanctum')->get('/lectures/{id}',[TeacherController::class,'teacherWeeklyLectures']);
Route::middleware('auth:sanctum')->get('/lectureStudents/{id}',[LectureController::class,'lectureStudents']);
Route::middleware('auth:sanctum')->post('/attendence',[TeacherController::class,'takeTheAttendence']);