<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CambioCorreoClave extends Mailable
{
     use Queueable, SerializesModels;

    public $url;
    public $data;

    public function __construct($url, $data)
    {
        $this->url = $url;
        $this->data = $data;
        
    }

    public function build()
    {
   
        return $this->subject('Cambiar Contraseña')
                    ->view('mail.updatePassword-email');
    }
}