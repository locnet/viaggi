<?php

namespace App\Http\Controllers\Tours;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Exceptions\Handler;
use App\Procentajes;
use App\Lib\XmlConector;
use App\Lib\XmlParser;
use Session;
use Input;

class BookingController extends Controller
{

    private $xmlConector;
    private $procentajes;

    function __construct(XmlConector $xmlConector,Procentajes $procentajes)
    {
        $this->xmlConector = $xmlConector;
        $this->procentajes = $procentajes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Input::flash();
        $validate = $this->validate($request, [
            'entrada'         => 'required|date_format:Y-m-d',
            'salida'          => 'required|date_format:Y-m-d',
            'adult_in_room_1' => 'digits_between: 1,4',
            'hotelId'         => 'required'
            ]);
        // numero habitaciones
        $roomsNumber = $request->input('roomsNumber');
        $hotelId = $request->input('hotelId');

        /* pagina donde y valores categoria minima y precio maximo
         * vienen de result.blade.php y hay que mandarles de vuelta
         * a HotelController.php
         */
        $activePage = $request->input('activePage');
        $activeCategory = $request->input('activeCategory');
        $activePrice = $request->input('activePrice');
        // dd($request->all());
        /** habitaciones, adultos, niños y edades niños
        *   a mandar al HotelBooking
        */
        $bookingParameters = "";
        try{
            /** DETALLES HOTEL */
            $xml = new XmlConector();
            $xml->servicio = "200";
            // zona
            $zona = " ";
            if ($request->input('zona') !== 0) {
              $zona = ' zone="'.$request->input('zona').'" ';
            }
            // parametros de la llamada
            $param = '<PARAMETERS language="2" building_id="'.$hotelId.'"></PARAMETERS>'; 
            //dd($param);
            $xml->parametros = $param;
            //dd($xml->parametros);
            $hotel = new xmlParser($xml->getString()); 
            // dd($hotel);
            
            /** HABITACIONES Y PRECIOS */
            $xml->servicio = "1400";
            $param = '<PARAMETERS language="2" building_id="'.$hotelId.'"';
            $param .= ' check_in="'.$request->input('entrada').'" '.
                      ' check_out="'.$request->input('salida').'" '.
                      ' tourism_type="" pay_mode="A" filter="PR">';
            $param .= $request->input('bookingParamters');
            $param .= '</PARAMETERS>';
            $xml->parametros = $param;
            $acomod = new xmlParser($xml->getString());
            // dd($acomod);

            // procentaje agencia sobre el precio del hotel          
            $procent = $this->procentajes->first();

            if ($hotel->hasError() || $acomod->hasError()){
                return view('hotel.search_error',compact('hotel','acomod'));
            } else {
                // devolvemos el view con los datos del hotel y la pagina
                return view('hotel.book',compact('hotel','acomod','activePage','procent',
                                       'activePrice','activeCategory','roomsNumber'));
            }
        } catch(Exception $e) {
            $parserErrors = $e->getMessage();
            dd($parserErrors);
            exit();
        }
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function makebooking(Request $request)
    {
        // return dd($request->all());

        Input::flash();
        $validate = $this->validate($request, [
            'entrada' => 'required|date_format:Y-m-d',
            'salida' => 'required|date_format:Y-m-d',
            'adult_in_room_1' => 'digits_between: 1,4',
            'buildingId' => 'required|numeric',
            'boardId' => 'required',
            'totalPrice' => 'required'
            ]);
        $bookingData = $request->input();
        return view('hotel/make_booking',compact('bookingData'));
    }
}
