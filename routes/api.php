<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ArticleController;
use App\Http\Controllers\Api\v1\UserController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('allUser', function() {

});
//seprate base on user version
Route::group(['prefix'=>'v1', 'as'=>'v1.','namespace' => 'App\Http\Controllers\Api\v1'], function() {
    Route::get('articles', [ArticleController::class,'articles']);
    Route::post('comments', [ArticleController::class,'comments']);
    Route::middleware('auth:sanctum')->group(function() {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });


    Route::post('login',[UserController::class,'login']);
});