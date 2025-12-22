<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisitaConfirmada extends Mailable
{
    use Queueable, SerializesModels;

     public $gestion;
    public $fecha;
    public $hora;

    public function __construct($gestion, $fecha, $hora)
    {
        $this->gestion = $gestion;
        $this->fecha = $fecha;
        $this->hora = $hora;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        return $this->subject('Confirmación Visita Programada')
            ->view('emails.visita_confirmada');
    }
}
