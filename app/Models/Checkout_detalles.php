<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout_detalles extends Model
{
    protected $fillable = ['checkout_id','articulo_id','cantidad'];

    public function articulo()
    {
        return $this->belongsTo(Articulos::class);
    }
}
