<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class UserOnlineListener
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
    public function handle(object $event, $id): void
    {
        $user = DB::table('users')->where('user', $id)->first();

        if ($user && now()->diffInSeconds($user->updated_at) >= 600000) {
            //Logic for logout here
        }
    }
}
