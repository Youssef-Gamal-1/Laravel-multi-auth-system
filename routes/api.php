<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProgramController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login',[\App\Http\Controllers\Auth\AuthController::class,'login']);
Route::post('/register',[\App\Http\Controllers\Auth\AuthController::class,'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('/programs',ProgramController::class);
    Route::apiResource('programs.courses',\App\Http\Controllers\CourseController::class)->only(['index','show']);
    Route::apiResource('/courses',\App\Http\Controllers\CourseController::class);
    Route::apiResource('/programs.standards',\App\Http\Controllers\StandardController::class);
});

//Route::apiResource('/programs/{program}/courses',\App\Http\Controllers\ProgramCourseController::class);
