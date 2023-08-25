<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\collage\collageController;
use App\Http\Controllers\material\materialController;
use App\Http\Controllers\questions\QuestionController;
use App\Http\Controllers\complaint\complaintController;




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
Route::get('/majorfor',[collageController::class,'majorfor']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/allmajor',[collageController::class,'allmajor']);
Route::post('/register',[AuthController::class,'register']);
Route::post('/logout',[AuthController::class,'logout']);
Route::post('/login',[AuthController::class,'login']);

Route::group([
      'middleware' => ['auth:sanctum']
  ],function (){
    Route::post('/edit_profile',[UserController::class,'showProfile']);
    Route::post('/update_profile',[UserController::class,'updateProfile']);

    Route::post('/update-profile', [UserController::class ,'updateProfile']);
    // Route::post('/update-multi-image', [imageController::class ,'uploadUserImage']);
    Route::get('/materials',[materialController::class,'show']);
    Route::post('/Add-complaint',[complaintController::class,'addComplaint']);

  //  Route::get('/show-cycles',[ QuestionController::class,'showCycles']);

 Route::get('/all-cycles',[QuestionController::class,'all_cycles']);
 Route::get('/all-cycles-questions',[QuestionController::class,'all_cycle_questions']);
 Route::get('/book-questions',[QuestionController::class,'book_questions']);
 Route::get('/collage-cycles',[QuestionController::class,'collage_cycles']);

  });
