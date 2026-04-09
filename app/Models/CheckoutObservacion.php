<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutObservacion extends Model
{

    protected $table = 'checkout_observaciones';

    protected $fillable = [
        'checkout_id',
        'observacion'
    ];
}
