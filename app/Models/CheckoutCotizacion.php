<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutCotizacion extends Model
{
    use HasFactory;

    protected $table = 'checkout_cotizaciones';

    protected $fillable = [
        'checkout_id',
        'numero_cotizacion',
        'fecha',
        'cliente_nombre',
        'contacto',
        'email',
        'telefono',
        'departamento',
        'subtotal',
        'iva',
        'total',
        'observaciones',
        'estado'
    ];

    public function checkout()
    {
        return $this->belongsTo(Checkout::class);
    }

    public function detalles()
    {
        return $this->hasMany(CheckoutCotizacionDetalle::class, 'checkout_cotizacion_id');
    }
}
