<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Subscriber extends Mailable
{
    use Queueable, SerializesModels;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->email    = $request['email'];
        $this->fullname = $request['fullname'];
        $this->message  = $request['message'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Contact Form')->view(
            'common.email.send', 
            [
                'fullname'=>$this->fullname, 
                'content'=>$this->message, 
                'email'=>$this->email
            ]
            )->to('info@mfj360pro.com')->from('info@mfj360pro.com','MFJ 360 PRO');
    }
    
}
