<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;


class Procentajes extends Model
{
    protected $fillable = ['agencias','publico'];
    /**
     * Price helper function.
     *
     * @return $price
     */
    public function makeHotelPrice(Procentajes $procentajes, 
    	                          $priceType, $hotelPrice, $hotelPvpPrice) {

        $procent = $procentajes->all()->first();
        
        $agSession = Session::has('agency');
        $agencia = $procent['agencia'];
        $publico = $procent['publico'];
        $precio = 0;
        if (strlen($agencia == 1)){
            $agencia = "1.0".$agencia;
        } else {
            $agencia = "1.".$agencia;
        }

        if (strlen($publico == 1)){
            $publico = "1.0".$publico;
        } else {
            $publico = "1.".$publico;
        }

        if (strlen($priceType) == 0) {
            $priceType = "R";
        }

        if (($priceType == "R") || ($priceType == "V")){
            if ($agSession) {
                $precio = $hotelPrice * strval($agencia);
            } else {
                $precio = $hotelPrice * strval($publico);
            }
        } 
        if ($priceType == "V"){
            
            if ($precio > $hotelPvpPrice) {
                $precio = $hotelPvpPrice;
            }            
        }
        
        return number_format($precio,2);
    }
}
