<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // diz pro laravel que o item é um array e não uma string
    protected $casts = [
        'items' => 'array'
    ];

    protected $dates = ['date']; // diz pro laravel que o campo date é uma data
    // criando um campo date para o laravel

    // adicionando usuário que é dono do evento

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    //belongsTo pertence a um usuário
}
