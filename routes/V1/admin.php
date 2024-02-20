<?php

   use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\HybridController;
use Illuminate\Support\Facades\Route;
   use App\Http\Controllers\AssignSubjectToTeacher;




   //public
   Route::post('/login',[AdminController::class,'login']);
   Route::post('/register',[AdminController::class,'store']);


   // TODO: TO BE AUTHENTICATED AND AUTHORIZED ONLY FOR ADMINS
   Route::post('/teacher-to-subject-attachment',AssignSubjectToTeacher::class);
   
// TODO: TO BE AUTHENTICATED AND AUTHORIZED ONLY FOR ADMINS
Route::post('/teacher-to-subject-attachment',[AdminController::class, 'assignSubjectToTeacher']);
Route::post('/student-assignment',[AdminController::class, 'assignStudentToSemester']);


Route::middleware('auth:sanctum')->get('/absence/{id}',[HybridController::class,'absenceRatio']);
Route::middleware('auth:sanctum')->get('/grades/{id}',[HybridController::class,'studentGrades']);
