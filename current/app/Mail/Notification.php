<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Notification extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $email;
    public $password;
    public $message;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->subject('MFJ 360 PRO')
                ->view($this->data['view'], $this->data)
                ->to($this->data['email'])
                ->from('info@mfj360pro.com','MFJ 360 PRO');
            // )->to('info@mfj360pro.com')->from('info@mfj360pro.com','MFJ 360');
    }
}