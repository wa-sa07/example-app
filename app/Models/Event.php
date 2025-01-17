<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // diz pro laravel que o item é um array e não uma string
    protected $casts = [
        'items' => 'array'
    ];
}
