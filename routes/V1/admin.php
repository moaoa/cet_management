<?php

   use App\Http\Controllers\Api\AdminController;
   use Illuminate\Support\Facades\Route;
   use App\Http\Controllers\AssignSubjectToTeacher;




   //public
   Route::post('/login',[AdminController::class,'login']);
   Route::post('/register',[AdminController::class,'store']);


   // TODO: TO BE AUTHENTICATED AND AUTHORIZED ONLY FOR ADMINS
   Route::post('/teacher-to-subject-attachment',AssignSubjectToTeacher::class);
   
