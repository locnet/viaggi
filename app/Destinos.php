<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destinos extends Model
{
    //sobreescribimos el id
    protected $primaryKey = 'IdDestino';

    protected $fillable = ['NombreDestino','IdDestino'];

    public function zonas() 
    {
    	return $this->hasMany('App\Zonas');
    }
}
