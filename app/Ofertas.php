<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Ofertas extends Model
{
    protected $fillable = ['titulo','texto','foto','pdf','precio_agencias','precio_publico',
    'alojamiento','hotel_id','start','fin','idioma'];

     /**
     * Devuelve el precio de las ofertas segun si el usuario es agencia o particular.
     *
     * @param  int  $price
     * @return $price
     */
    public function getOferPrice($particular, $agencia) 
    {
    	if (Auth::user() && Auth::check()){
            return $agencia . " €";
    	} else {
            return $particular . " €";
        }
    }
}
