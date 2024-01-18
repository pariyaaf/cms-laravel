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
            dd('not found!');
            return redirect('/login');
        }

        if($activationCode->expire < Carbon::now()) {
            dd('expire!');
            return redirect('/login');
        }

        if($activationCode->used == 1) {
            dd('used!');
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
