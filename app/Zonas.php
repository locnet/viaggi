<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zonas extends Model
{
    protected $primaryKey = "IdZona";
    protected $fillable = ['IdZona','NombreZona','IdDestino'];
}
