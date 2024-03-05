<?php

use App\Http\Controllers\Api\HybridController;
use App\Http\Controllers\Api\StudentController;
use Illuminate\Support\Facades\Route;


// public

Route::post('/login',[StudentController::class,'login']);
Route::post('/register',[StudentController::class,'store']);


//protected
Route::middleware('auth:sanctum')->get('/showAll',[StudentController::class,'index']);
Route::middleware('auth:sanctum')->get('/show/{id}',[StudentController::class,'show']);
Route::get('/Schedules/{id}',[StudentController::class,'LectureSchedules']);
Route::get('/absence/{id}',[HybridController::class,'absenceRatio']);
Route::get('/grades/{id}',[HybridController::class,'studentGrades']);

Route::get('/absence/{id}',[HybridController::class,'absenceRatio']);
Route::get('/grades/{id}',[HybridController::class,'studentGrades']);
