<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ActivationCode;


class UserAController extends Controller
{
    

    public function activation($token) {
        $activationCode = ActivationCode::whereCode($token)->first();

        if(!$activationCode) {
            Alert::error('خطا در اعتبارسنجی', 'توکن نامعتبر است');
            return redirect('/login');
        }

        if($activationCode->expire < Carbon::now()) {
            Alert::error('خطا در اعتبارسنجی', 'توکن منقضی شده است.');
            return redirect('/login');
        }

        if($activationCode->used == 1) {
            Alert::error('خطا در اعتبارسنجی', 'توکن قبلا استفاده شده است');
            return redirect('/login');
        }

        $activationCode->update([
            'used'=>1

        ]);

        $activationCode->user()->update([
            'active'=>1
        ]);


        auth()->loginUsingId($activationCode->user->id);
        return redirect('/');
        
    }
}
