<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Auth;

class Tour extends Model
{
    protected $fillable = array('titulo', 'destino', 'visible','start', 'fin', 'descripcion','dias','hoteles',
        'idhoteles','foto','pdfp','pdfa','precio','preciopublico');

    
    /**
     * Devuelve el precio del tour si el usuario esta autentificado como agencia.
     *
     * @param  int  $price
     * @return $price
     */
    public function getTourPrice($price) 
    {
    	if (Auth::user() && Auth::check()){
    		Session::put('agencia','true');
            return $price . " €";
    	} else {
            Session::forget('agencia');
            return "";
        }
    }
}