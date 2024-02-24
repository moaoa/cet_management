<?php

use App\Http\Controllers\Api\AdminController;
use Illuminate\Support\Facades\Route;




//public
Route::post('/login', [AdminController::class, 'login']);
Route::post('/register', [AdminController::class, 'store']);


// TODO: TO BE AUTHENTICATED AND AUTHORIZED ONLY FOR ADMINS
Route::post('/teacher-to-subject-attachment', [AdminController::class, 'assignSubjectsToTeacher']);
Route::post('/student-assignment', [AdminController::class, 'assignStudentToSemester']);

Route::post('/teachers', [AdminController::class, 'addTeacher']);
Route::post('/students', [AdminController::class, 'addStudent']);
Route::post('/lectures', [AdminController::class, 'addLecture']);
