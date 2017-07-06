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
    public function makeHotelPrice($priceType, $hotelPrice, $hotelPvpPrice) {

        $procent = $this->all()->first();
        
        $agSession = Session::has('agency');
        $agencia = ($procent['agencia'] + 100) / 100;
        $publico = ($procent['publico'] + 100) / 100;
        $precio = 0;
        

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
