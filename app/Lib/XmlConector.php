<?php 
namespace App\Lib;

use App;
use SoapClient;
use Session;
use Config;
use App\Exceptions;

/*
* soap client with SoapClient librarys included in PHP > 5.0
*/
class XmlConector
{
    
	
	private $soapClient;
	public $parametros;
	public $servicio;
	
	/**
	* Las constantes utilizadas son declaradas en el fichero app/config/constants.php
	*/
	public function __construct(){
		if(App::environment('local')){
			   	$wsdl = Config::get('constants.DEVELOPMENT_WSDL');
		    }else{
		    	// hay que borrar la primera linea y descomentar la segunda 
		    	// para poner en produccion
		    	$wsdl = Config::get('constants.DEVELOPMENT_WSDL');
			    //$wsdl = Config::get('constants.PRODUCTION_WSDL');
		}	
		//creamos un cliente, si no tiro una exception
		if(!$this->soapClient = new SoapClient($wsdl)){
			throw new Exception('No se ha podido conectar con el servidor webservice!');
		}
	}
	

	public function getString(){
		//para ver los parametros descomentar la siguiente linea, solo debugging
		// print_r(htmlspecialchars($this->parametros));

		//conecto con la api de  SideTours
		try {		
			if($result = $this->soapClient->SERVICE($this->servicio,
				                 Config::get('constants.USUARIO'),
				                 Config::get('constants.CLAVE'),
				                 $this->parametros)){
				return $result;
			} else {
				throw new Exception("XmlConector: no tengo conexion!");
			}
	    } catch (Exception $e){
	    	echo $e->getMessage();
	    }
		
	}	
}