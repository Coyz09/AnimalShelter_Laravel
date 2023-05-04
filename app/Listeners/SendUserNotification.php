<?php

namespace App\Listeners;

use App\Events\RescuerCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
class SendUserNotification
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
     * @param  RescuerCreated  $event
     * @return void
     */
   public function handle(RescuerCreated $event)
    {
        $name = $event->animal_name;
        $type = $event->animal_type;
        $breed = $event->animal_breed;
        $email = "france@gmail.com";

        Mail::send(
            'emails.notify',
            ['name'=>$name,'type'=>$type,'breed'=>$breed],
            function($message) use($email) {
                $message->from('shelter@test.com','Admin');
                $message->to($email,"Employee");
                $message->subject('New animal rescued!');
            }
        );
    }
}
