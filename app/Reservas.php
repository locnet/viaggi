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

    protected $casts = ['precio' => 'float'];

    /**
    * devuelve todas las reservas hechas con un email en particular
    * @param object $query
    * @param string $email
    */
    public function scopeBookedBy($query,$email)
    {
    	return $query->where('email',$email);
    }

    /**
    * devuelve las reservas entre un rango de precios
    * @param object $query
    * @param int $min
    * @param int $max
    */

    public function scopeYearSales($query, $year)
    {
        return $query->whereYear('created_at','=',$year);
    }

    /**
    * devuelve el total de las reservas hechas en un rango de fechas
    * @param string $query
    * @param int $month
    * @param int $year
    */

    public function scopeMonthlySales($query,$month,$year)
    {
        return $query->whereMonth('created_at','=',$month)
                    ->whereYear('created_at','=',$year);
    }
    
}
