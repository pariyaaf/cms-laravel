<?php
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Home\CourseController as HomeCourseController;
use App\Http\Controllers\Home\ArticleController as HomeArticleController;

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\EpisodeController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\LevelManageController;
use App\Http\Controllers\UserAController;

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\AuthenticatedSessionController;
// use App\Http\Controllers\Auth\RegisteredUserController;
// use App\Http\Controllers\Auth\PasswordResetLinkController;
// use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Events\UserActivation\UserActivation;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Events\articleEvent;

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

// Route::get('/', function () {
//     // $user = User::find(1);
//     // return event(new UserActivation($user));
//     // auth()->loginUsingId(7);
//     // alert()->error('Oops...', 'Something went wrong!')->footer('<a href="#">Why do I have this issue?</a>');
//     // return view('Admin.panel', compact('labels', 'values'));
//     // dd(Auth::user());
//     // return ('done');
//     return view('welcome');
// });

Route::get('/' , function (){
//     $user = User::find(2);
//    event(new ArticleEvent($user));
//    return 'done';
return view('Home.index');
});


Route::get('/alert', function () {
    alert()->error('Oops...', 'Something went wrong!')->footer('<a href="#">Why do I have this issue?</a>');
    // return ('done');
    return view('welcome');

});

Route::get('user/active/email/{token}',[UserAController::class, 'activation'])->name('activation.account');

Route::group(['prefix'=>'admin', 'as'=>'admin.', 'middleware' => ['auth:web', 'CheckAdmin']], function() {
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

Route::group(['namespace' => "App\Http\Controllers\Auth"], function () {
    // Authentication Routes...
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class,'login']);
    Route::get('logout',  [LoginController::class,'logout'])->name('logout');
    
    // Registration Routes...
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    
    // Password Reset Routes...
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');
    
    // Confirm Password 
    Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);
    
    // Email Verification Routes...
    Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::get('email/resend',  [VerificationController::class, 'resend'])->name('verification.resend');
    // Home Route
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    //login and register with google
        //یکی برای لاگین یکی هم برای کال بک
    Route::get('login/google',[LoginController::class,'redirectToProvider']);
    Route::get('login/google/callback', [LoginController::class,'handleProviderCallback']);
});
// Auth::routes();


//  Route::post('/upload',[TestController::class,'testUploadImage']);


Route::get('/getData' , function(){
    $validator = \Validator::make(request()->all(),[
        'name' => 'required',
        'pic' => 'required'//pic dir
    ]);

    if($validator->fails()) {
        return $validator->errors()->all();
    }

    $file = request()->file('pic');
    $year = Carbon::now()->year;
    $imagePath = "/upload/images/{$year}/";
    $filename = $file->getClientOriginalName();

    $file = $file->move(public_path($imagePath) , $filename);

    return $imagePath . $filename;
});




// main route for site
route::get('/',[HomeController::class,'index']);
route::get('/articles/{articleSlug}',[HomeArticleController::class,'single']);
route::get('/courses/{courseSlug}',[HomeCourseController::class,'single']);
route::post('/comment',[HomeController::class,'comment']);
// route::get('/articles',[ArticleController::class,'redirectToProvider']);
// route::get('/courses',[CourseController::class,'redirectToProvider']);
