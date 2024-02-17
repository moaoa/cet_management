<?php

use App\Http\Controllers\Api\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('student')->group(function(){
    
    //public
    Route::post('/login',[StudentController::class,'login']);
    Route::post('/register',[StudentController::class,'store']);
    

    //protected
    Route::middleware('auth:sanctum')->get('/showAll',[StudentController::class,'index']);
    Route::middleware('auth:sanctum')->get('/show/{id}',[StudentController::class,'show']);

});


Route::prefix('teacher')->group(function(){
    
    //public
    Route::post('/login',[TeacherController::class,'login']);
    Route::post('/register',[TeacherController::class,'store']);
    

    //protected
    Route::middleware('auth:sanctum')->get('/showAll',[TeacherController::class,'index']);
    Route::middleware('auth:sanctum')->get('/show/{id}',[TeacherController::class,'show']);

});

Route::prefix('admin')->group(function(){
    
    //public
    Route::post('/login',[AdminController::class,'login']);
    Route::post('/register',[AdminController::class,'store']);
    
});