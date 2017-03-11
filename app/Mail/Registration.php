<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Registration extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
       
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
          $address = 'g.abdala.04@gmail.com';
          $name = 'Ignore Me';
          $subject = 'Krytonite Found';

           //public $name = "G hola!";

        return $this->view('mail.registration')
                    ->from($address, $name)
                    ->cc($address, $name)
                    ->bcc($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject);
    }
}
