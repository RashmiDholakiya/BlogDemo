<?php

namespace App\Listeners;

use App\Events\LoginDone;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events;
use Illuminate\Support\Facades\Mail;

class Sendmail
{
    /**
     * Create the eveant listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LoginDone  $event
     * @return void
     */
    public function handle(LoginDone $user)
    {

        $st=Mail::send([],[], function($message) use($user){
            $message->to($user->user['username'], '')
                ->subject('Welcome to the BlogSystem!')
                ->setBody('Thankyou For Registration...');
        });


    }
}
