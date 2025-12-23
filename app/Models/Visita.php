<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    protected $fillable = [
        'gestion_id',
        'fecha_visita',
        'hora_visita',
        'comentario',
        'estado'
    ];


    public function gestion()
    {
        return $this->belongsTo(Gestiones::class);
    }
}
