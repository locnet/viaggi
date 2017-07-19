<?php
namespace App\Lib\CustomClasses;

use App;

/*-------------------------------------------|
|           CLASE ESTATICA                   |
|--------------------------------------------|*/

class SpanishDate{
	
    /**
     * Devuelve el nombre del edificio segun su codigo.
     *
     * @return $type, nombre del edificio
     */
	public static function getDayName() {
        $fecha = [
                 'dia' => ['domingo','lunes','martes','miercoles','jueves','viernes','sabado',],
                 'mes' => ['enero','febrero','marzo','abril','mayo','junio','julio',
                          'agosto','septiembre','octubre','noviembre','diciembre']
                ];
        return $fecha;
    }
}