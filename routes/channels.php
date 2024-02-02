<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/
// this is for private
Broadcast::channel('articels.{type}', function ($user, $type) {
     if( $user->level == 'admin') {
        return true;
    } 
    return false;
});
