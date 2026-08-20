<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Tecnicos;
use App\Models\Edificio;
use App\Models\Checkout_detalles;
use App\Models\CheckoutObservacion;
use Illuminate\Database\Eloquent\SoftDeletes;


class Checkout extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'edificio_id',
        'tecnico_id',
        'bloque',
        'fecha_inicio',
        'fecha_termino',
        'monto_neto',
        'estado',
        'pdf_solicitud',
        'pdf_entrega',
        'pdf_oc',
        'pdf_factura',
        'nro_oc',
        'nro_factura'
    ];

    public function detalles()
    {
        return $this->hasMany(Checkout_detalles::class);
    }

    public function tecnico()
    {
        return $this->belongsTo(Tecnicos::class);
    }

    public function edificio()
    {
        return $this->belongsTo(Edificio::class);
    }

    public function observaciones()
    {
        return $this->hasMany(CheckoutObservacion::class, 'checkout_id');
    }

    public function cotizaciones()
    {
        return $this->hasMany(CheckoutCotizacion::class, 'checkout_id');
    }
}
