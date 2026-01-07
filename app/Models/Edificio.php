<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\gestiones;

class Edificio extends Model
{
    protected $fillable = [
        'nombre',
        'direccion',
        'comuna'
    ];

    public function gestiones()
    {
        return $this->hasMany(Gestiones::class);
    }
}
