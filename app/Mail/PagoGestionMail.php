<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\gestiones;
use Illuminate\Mail\Mailable;

class PagoGestionMail extends Mailable
{
    public $gestion;
    public $pago;

    public function __construct(Gestiones $gestion)
    {
        $this->gestion = $gestion;
        $this->pago = config('pagos');
    }

    public function build()
    {
        return $this->subject('💳 Información de pago – Solicitud de mantención')
            ->view('emails.pago_gestion');
    }
}
