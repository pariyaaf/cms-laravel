<?php

namespace App\Listeners\UserActivation;

use App\Events\UserActivation\UserActivation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\ActivationUserAccount;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;


class SendMailNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserActivation $event): void
    {
        // return route('activation.account',$event->activationCode);

        // dd('gsgs');

        Mail::to($event->user)->send(new ActivationUserAccount($event->user, $event->activationCode));
        // Mail::to('recipient@example.com')->send(new TestMail());
    } 
}
