<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
 
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'), 'Pierce-Me')
                    ->subject('User Registration')
                    ->view('front.registration')
                    ->with(['user' => $this->user]);
    }
}
