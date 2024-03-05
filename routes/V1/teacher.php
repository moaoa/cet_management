<?php

use App\Http\Controllers\Api\LectureController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\TeacherController;
use Illuminate\Support\Facades\Route;


//public
Route::post('/login',[TeacherController::class,'login']);
Route::post('/register',[TeacherController::class,'store']);


//protected
Route::middleware('auth:sanctum')->get('/showAll',[TeacherController::class,'index']);
Route::middleware('auth:sanctum')->get('/show/{id}',[TeacherController::class,'show']);
Route::get('/lectures/{id}',[TeacherController::class,'teacherWeeklyLectures']);
Route::middleware('auth:sanctum')->get('/lectureStudents/{id}',[LectureController::class,'lectureStudents']);
Route::middleware('auth:sanctum')->post('/attendence',[TeacherController::class,'takeTheAttendence']);
Route::middleware('auth:sanctum')->get('/teacherSubjects/{id}',[TeacherController::class,'teacherSubjects']);
Route::middleware('auth:sanctum')->get('/subjectStudents/{id}',[SubjectController::class,'subjectStudents']);
Route::middleware('auth:sanctum')->post('/addingStudentGrades',[TeacherController::class,'addingStudentGrades']);
