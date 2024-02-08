<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use App\Models\Comment;
use App\Models\Payment;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);   
        Validator::extend('recaptcha', function ($attribute, $value, $params, $vaidator){
            $client = new Client();
            $res = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret' => config('services.recaptcha.secret'),
                    'response' => $value,
                    'remoteip' => request()->ip(),
                ]
            ]);

            if ($res->getStatusCode() == 200) {
               $result = json_decode( $res->getbody());
                return $result->success;

            }
            return false;

        });

        view()->composer('Admin.section.header' , function($view) {
            $unsuccessful = Comment::where('approved', 0)->count();
            $successful = Comment::where('approved', 1)->count();
            $unsuccessfulPayment = Payment::where('payment', 0)->count();
            $successfulPayment = Payment::where('payment', 1)->count();
            $view->with([
                'unsuccessful' => $unsuccessful,
                'successful' => $successful,
                'unsuccessfulPayment' => $unsuccessfulPayment,
                'successfulPayment' => $successfulPayment,
                ]);
        });
    }

}