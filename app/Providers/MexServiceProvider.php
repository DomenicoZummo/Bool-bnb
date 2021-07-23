<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Message;
use Illuminate\Support\Facades\Auth;

class MexServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        /**
         * number of new messages passed in the layout/navbar
         */

        View::composer('layouts.mex', function( $view )
        {      

            $user = Auth::user();
            $user_id = $user['id'];

            $messages = Message::with('apartment')->get();

            $user_messages = [];
            $unread_messages = [];

            foreach ($messages as $message) {
                if ($user_id == $message->apartment['user_id']) {
                    $user_messages[] = $message;

                    if ($message->read == 0) {
                        $unread_messages[] = $message;
                    }
                }
            }



            $view->with( 'unread_messages', $unread_messages );
        } );
    }
}
