<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PagoConfirmado extends Mailable
{
    use Queueable, SerializesModels;

    public $gestion;

    public function __construct($gestion)
    {
        $this->gestion = $gestion;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
     public function build()
    {
        return $this->subject('Pago confirmado')
                    ->view('emails.pago_confirmado');
    }
}
