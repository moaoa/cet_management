<?php

use App\Http\Controllers\Api\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\AssignSubjectToTeacher;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



// Route::post('/register',[StudentController::class,'store']);
// Route::get('/find/{id}',[StudentController::class,'show']);
// Route::post('/login',[StudentController::class,'login']);
// Route::post('/teacher-to-subject-attachment/{teacher_id}/{subject_id}',AssignSubjectToTeacher::class);
