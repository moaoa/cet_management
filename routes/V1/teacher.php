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
Route::get('/lectureStudents/{id}',[LectureController::class,'lectureStudents']);
Route::post('/attendence',[TeacherController::class,'takeTheAttendence']);
Route::get('/teacherSubjects/{id}',[TeacherController::class,'teacherSubjects']);
Route::get('/subjectStudents/{id}',[SubjectController::class,'subjectStudents']);
Route::post('/addingStudentGrades',[TeacherController::class,'addingStudentGrades']);
