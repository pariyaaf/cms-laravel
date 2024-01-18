<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use App\Events\UserActivation\UserActivation;
use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }



        //here

        if(auth()->validate($request->only('email' , 'password'))) {//بررسی اینکه وجود داره
            $user = User::whereEmail($request->input('email'))->first();//چک میکنه کسی با این ایمیل وجود داره
            if($user->active == 0 ) {//بررسی اینکه یوزر اکتیو هست یا نه 
                $checkActiveCode = $user->activationCode()->where('expire' , '>=' , Carbon::now() )->latest()->first();//چک میکنه این کاربره ایا اکتیوشن کدی داره که هنوز انقضا داشته باشه
                if( $checkActiveCode!= null && count(array($checkActiveCode)) == 1) {// چک می کنه که  وجود داشت
                    if($checkActiveCode->expire > Carbon::now() ) {//اینجا باز دوباره چک می کنه که مطمعن شیم 
                        $this->incrementLoginAttempts($request);//  اینجا از یه متد دیگه استفاده می کنه میاد چک می کنه که طرف توی هر دفیقاه نهایت 5 بار بتونه در خواست لاگین بده. اینجوری بهتر مدیذیت میشه و بهتره
                        return back()->withErrors(['code' => 'ایمیل فعال سازی قبلا به ایمیل شما ارسال شد بعد از 15 دقیقه دوباره برای ارسال ایمیل لاگین کنید']);//  این پیام خطا رو به کاربر نمایش میده 
                    }
                } else {
                    event(new UserActivation($user));// در غیر این صورت میره که ایونت ارسال ایمیل رو صدا بزنه
                }
            }
        }


        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    
    //google

    //ما رو میبره به گوگل
    public function redirectToProvider() {
        //get information from drvier google i add in services.php  and redirect to google
        return Socialite::driver('google')->redirect();        
    }

    // جواب گوگل رو برای ما بر می گردونه
    public function handleProviderCallback(){
        //add stateless
        $social_user = Socialite::driver('google')->stateless()->user();
        $user = User::whereEmail($social_user->getEmail())->first();

        if(!$user) {
            $user  = User::create([
                'name'=>  $social_user->getName(),
                'email'=>  $social_user->getEmail(),
                'password' => Hash::make($social_user->getId()),
                // 'active'=>
                // 'level' defalut
                // 'created-at'
                // 'email_verified_at'
            ]);
        }

        if($user->active == 0) {
            $user->update([
                'active' => 1
            ]);
        }
        auth()->loginUsingId($user->id);
        return redirect('/');
    }
}
