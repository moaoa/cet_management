<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('student', App\Http\Controllers\Api\StudentController::class)->only('index', 'store', 'show');

Route::resource('teacher', App\Http\Controllers\Api\TeacherController::class)->only('index', 'store', 'show');

Route::resource('semester', App\Http\Controllers\Api\SemesterController::class)->only('index', 'store', 'show');

Route::resource('subject', App\Http\Controllers\Api\SubjectController::class)->only('index', 'show', 'store');

Route::resource('group', App\Http\Controllers\Api\GroupController::class)->only('index', 'show', 'store');

Route::resource('lecture', App\Http\Controllers\Api\LectureController::class)->only('index', 'show', 'store');

Route::resource('class-room', App\Http\Controllers\Api\ClassRoomController::class)->only('index', 'show', 'store');
