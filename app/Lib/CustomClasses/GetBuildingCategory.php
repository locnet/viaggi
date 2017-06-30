<?php

namespace App\Lib\CustomClasses;

use App;

/*-------------------------------------------|
|           CLASE ESTATICA                   |
|--------------------------------------------|*/

class GetBuildingCategory{
	
    /**
     * Devuelve el nombre del edificio segun su codigo.
     *
     * @return $type, nombre del edificio
     */
	public static function getType($t)
	{
        $type = array(
            4 => "Hotel",
            5 => "Apartamentos",
            6 => "Aparthotel",
            8 => "Club",
            9 => "Agroturismo",
            10 => "Hostal",
            12 => "Casas", 
            13 => "Villas",
            32 => "Hotel Rural",
            14 => "Bungalows",
            21 => "Apartamentos",
            23 => "Complejo turistico",
            22 => "Apartamentos 2-a",
            26 => "Complejo turistico",
            27 => "Residencial/Hotel",
            28 => "Hotel",29 =>"Hotel",
            33 => "Hotel Rural",
            41 => "Albergue",
            43 => "Hotel"
            );
        
        return $type[$t];        
    }
}