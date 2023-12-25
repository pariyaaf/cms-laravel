<?php
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\ArticleController;

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


Route::group(['prefix'=>'admin', 'as'=>'admin.'], function() {
    Route::resource('panel', PanelController::class);
    Route::resource('articles', ArticleController::class);

    //for ckeditor
    Route::post('panel/upload-image',[PanelController::class, 'uploadImage']);

});

// Route::namespace('Admin')->prefix('admin')->group(function() {
//     // Route::resource('panel', PanelController::class);
//     $this->get('/panel'.'PanelController@index');
// });
