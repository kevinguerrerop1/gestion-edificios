<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutCotizacionDetalle extends Model
{
    use HasFactory;

    protected $table = 'checkout_cotizacion_detalles';

    protected $fillable = [
        'checkout_cotizacion_id',
        'detalle_servicio',
        'valor_unitario',
        'unidades',
        'total_linea'
    ];

    public function cotizacion()
    {
        return $this->belongsTo(CheckoutCotizacion::class, 'checkout_cotizacion_id');
    }
}
