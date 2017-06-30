<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    // mass asignment
     protected $fillable = [
        'locata','nombre','telefono','email','fechareserva','precio','control',
        'adultos','menores'
    ];
    
}
