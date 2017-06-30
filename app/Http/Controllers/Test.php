<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Lib\XmlConector;
use App\Lib\XmlParser;

class Test extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hotel_category()
    {
        $xml = new xmlConector();
        $xml->servicio = "102";
        $parserNodes['nod'] = false;
        $parserNodes['subnod'] = false;
        $category = array();//hago un array para pasar los hoteles
        
        try{
            $xml->parametros = '2';
            $result = $xml->getString();//esto me devuelve un string XML
            print_r(htmlspecialchars($result));//solo para debugging
            //inicializo la clase que me procesa el string xml
            $category[] = new xmlParser($xml->getString());
         }
         catch(Exception $e){
             echo $e->getMessage();
             exit();
         } 
         return dd($category);                       
    }

}
