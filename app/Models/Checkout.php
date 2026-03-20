<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Tecnicos;
use App\Models\Edificio;
use App\Models\Checkout_detalles;


class Checkout extends Model
{
    protected $fillable = [
        'edificio_id','tecnico_id','bloque',
        'fecha_inicio','fecha_termino',
        'pdf_solicitud','pdf_entrega'
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
}
