<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gestiones extends Model
{
    protected $fillable = [
        'departamento',
        'titulo',
        'descripcion',
        'nombre_contacto',
        'telefono_contacto',
        'email_contacto',
        'estado'
    ];

    public function visitas()
    {
        return $this->hasMany(\App\Models\Visita::class, 'gestion_id');
    }
}
