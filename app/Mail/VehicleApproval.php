<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VehicleApproval extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $vehicle;

    public function __construct($user, $vehicle)
    {
        $this->user = $user;
        $this->vehicle = $vehicle;
    }

    public function build()
    {
        return $this->from(env('MAIL_USERNAME'), 'vqlr')
                    ->subject('User Vehicle Approval')
                    ->view('front.approval')
                    ->with([
                        'user' => $this->user,
                        'vehicle' => $this->vehicle
                    ]);
    }
}