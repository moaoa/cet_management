<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssignSubjectToTeacher;


// TODO: TO BE AUTHENTICATED AND AUTHORIZED ONLY FOR ADMINS
Route::post('/teacher-to-subject-attachment',AssignSubjectToTeacher::class);
