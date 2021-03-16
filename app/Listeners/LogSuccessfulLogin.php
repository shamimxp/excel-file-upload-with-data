<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
//        if ($event->guard == 'admin'){
//            $model = new Admin();
//        }elseif ($event->guard == 'seller'){
//            $model = new Seller();
//        }else{
//            $model = new User();
//        }
        $model = new User();
        activity($event->guard.'_login')
            ->causedBy($event->user->id)
            ->performedOn($model)
            ->withProperties([
                'login_ip' => \request()->ip(),
                'user_agent' => \request()->userAgent(),
            ])
            ->log('Success');
    }
}
