<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    protected $fillable = [
        'nombre',
        'direccion',
        'comuna',
        'ciudad',
        'observacion'
    ];

    public function gestiones()
    {
        return $this->hasMany(Gestiones::class);
    }
}
