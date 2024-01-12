<?php
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\EpisodeController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\LevelManageController;

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
    Route::resource('courses', CourseController::class);
    Route::resource('episode', EpisodeController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('levels', LevelManageController::class);


    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {//, 'middleware' => ['can:manage_users']]
        Route::get('/', [UserController::class, 'index']);
        Route::delete('{id}/destroy', [UserController::class, 'destroy'])->name('destroy');
    });
    

    Route::get('test', [TestController::class, 'index']);
    Route::get('test/single/{post}', [TestController::class, 'single']);

    //for ckeditor
    Route::post('panel/upload-image',[PanelController::class, 'uploadImage']);

});

// Route::namespace('Admin')->prefix('admin')->group(function() {
//     // Route::resource('panel', PanelController::class);
//     $this->get('/panel'.'PanelController@index');
// });
