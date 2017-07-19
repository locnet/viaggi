<?php

namespace App\Http\Controllers\Hotel;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Exceptions\Handler;
use App\Procentajes;
use App\Lib\XmlConector;
use App\Lib\XmlParser;
use Session;
use Input;
use Carbon\Carbon;
use App\Reservas;
use Stripe;
Carbon::setLocale('es');

class BookingController extends Controller
{
    private $xmlConector;
    private $procentajes;
    private $reservas;

    function __construct(XmlConector $xmlConector,Procentajes $procentajes,
                         Reservas $reservas)
    {
        $this->xmlConector = $xmlConector;
        $this->procentajes = $procentajes;
        $this->reservas = $reservas;
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
            'entrada' => 'required|date_format:Y-m-d',
            'salida' => 'required|date_format:Y-m-d',
            'adult_in_room_1' => 'digits_between: 1,4',
            'hotelId' => 'required'
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
            $hotel = new XmlParser($xml->getString()); 
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
            $acomod = new XmlParser($xml->getString());
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
     * Eleccion acomodacion hotel
     *
     * @return \Illuminate\Http\Response
     */
    public function startBooking(Request $request)
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
        // dd($bookingData);
        return view('hotel/make_booking',compact('bookingData'));
    }
    
    /**
     * Confirmacion datos titulares reserva
     *
     * @return \Illuminate\Http\Response
     */

    public function confirmPaxData(Request $request)
    {
        Input::flash();
        $validate = $this->validate($request, [
            'room_1_contact' => 'required',
            'name'           => 'required',
            'last_name'      => 'required',
            'email'          => 'required|email',
            'phone'          => 'required|numeric'
            ]);
        $payData = $request->input();
        
        return view('hotel/confirm_booking',compact('payData'));
    }

    /**
     * Proceso de la reserva
     *
     * @return \Illuminate\Http\Response
     */
    public function makeBooking(Request $request)
    {
        Input::flash();
        $validate = $this->validate($request, [
            'stripeToken' => 'required',
            'amount'      => 'required|numeric',
            'buildingId'  => 'required',
            'entrada'     => 'required',
            'salida'      => 'required',
            'boardId'     => 'required',
            'roomsNumber' => 'required'
            ]);
        $input = $request->input(); 
        $bookingError = false;
        $param = "";

        // hacemos la reserva temporal, servicio 500, tenemos 20 minutos para pagar
        $locata = $this->makeTemporalBooking($input);

        if ($locata) {
            // la reserva esta hecha, pero no pagada
            // procesamos el pago y hacemos la reserva en firme

            if ($this->payBooking($locata,$input)){
                // tenemos la rezerva hecha y el pago realizado
                return redirect('hotel/ver/reserva/'.$locata);
            } else {
                return view('hotel/pay_booking_error');
            }
        } else {
            return view('hotel.booking_error',compact('booking'));
        }
    }

    /**
     * Reserva temporal
     *
     * @return \Illuminate\Http\Response
     */
    private function makeTemporalBooking($input) 
    {
        try{
            // PARAMETROS RESERVA
            $xml = new XmlConector();
            $xml->servicio = "500";

            // parametros de la llamada
            $param = '<PARAMETERS language="2" building_id="'.$input['buildingId'].'"
                      check_in = "'.$input['entrada'].'" 
                      check_out = "'.$input['salida'].'" 
                      board_id="'.$input['boardId'].'" no_booking="1">';
            if ($input['roomsNumber'] > 0) {
                for ($i=1;$i <= $input['roomsNumber']; $i++) {
                    $adult = $input['adult_in_room_'.$i];
                    $child = $input['child_in_room_'.$i];
                    $age = $input['room_'.$i.'_age_0'];
                    $contact = $input['room_'.$i.'_contact'];
                    $param .= '<ROOM adults="'.$adult.'" 
                                     children="'.$child.'" ';
                    if ($child > 0){
                        for ($x=0; $x<$child;$x++){
                            $param .= 'age'.$x.'="'.$age.'" ';
                        }
                    }
                    $param .= ' contact="'.$contact.'" aco="'.$input['aco'].'" />';
                }
            }
            $param .= '</PARAMETERS>';
            $xml->parametros = $param;

            $booking = new XmlParser($xml->getString()); 
            
            // resultado llamada
            if ($booking->hasError()){
                $locata = false;                                              
            } else {
                /**
                * la reserva esta hecha, tenemos 20 minutos para pagarla
                * saco el locata de la reserva
                */
                foreach($booking->getNodes('RESERVATION',false) as $book)
                {
                    if($book['locata'] > 0)
                    {
                        $locata = $book['locata'];            
                    }
                }
                
            }
            return $locata;

        } catch(Exception $e) {
            $parserErrors = $e->getMessage();
            dd($parserErrors);
            exit();
        }
    }

    /**
     * Pago reserva 
     *
     * @return \Illuminate\Http\Response
     * @param $locata   el localizador temporal
     * @param $input    the request data
     */
    private function payBooking($locata, $input) 
    {
        /* intentamos el pago, si todo sale bien reservamos en firme
         * primero comprobamos que no tengamos el locata en la db
         */
        if ($locata && Reservas::get()
                               ->where('control',$input["stripeToken"])
                               ->count() === 0) {

            $stripe = Stripe::setApiKey(env('STRIPE_SECRET'));
            try {
                $charge = $stripe->charges()->create([
                    'card'           => $input['stripeToken'],
                    'amount'         => $input['amount'],
                    'currency'       => 'eur',
                    'description'    => $input['description'],
                    'receipt_email'  => $input['email']
                ]);
            } catch(Exception $e){
                $bookingError = $e->getMessage();
                return false;
            }

            // pago realizado correctamente
            if ($charge['status'] === 'succeeded') {
                // confirmamos la reserva en firme
                try {
                    $xml = new XmlConector();
                    $xml->servicio = "504";
                    $param = "$locata";
                    $xml->parametros = $param;
                    $book = new XmlParser($xml->getString());

                    // insertamos en la base de datos de andalusiando
                    // los detalles de la reserva
                    Reservas::create(['locata'      => $locata,
                                     'nombre'       => $input['name']." ".$input['last_name'],
                                     'telefono'     => $input['phone'],
                                     'email'        => $input['email'],
                                     'precio'       => $input['totalPrice'],
                                     'control'      => $input['stripeToken'],
                                     'adultos'      => $input['adultos'],
                                     'menores'      => $input['menores']
                                     ]);
                    return true;
                }
                catch(Exception $e) {
                    $bookingError = $e->getMessage();
                    return false;
                }
            }
        } else {
            // ya tenemos este localizador en la base de datos
            return get_booking($locata);            
        }
    }

    /**
    * devuelve los detalles de una reserva hecha
    *
    * @param el localizador de la reserva
    */
 
    public function getBooking($locata) 
    {
        // detalles reserva en nuestra base de datos
        $reserva = $this->reservas->where('locata',$locata)->first();
        
        try {
            // detalles reserva en Sidetours
            $xml = new XmlConector();
            $xml->servicio = "502";
            $param =  '<PARAMETERS locata="'.$locata.'" language="2" />';
            $xml->parametros = $param;
            $booking = new XmlParser($xml->getString());
            $fecha = $this->spanishDate();        
            if ($booking->hasError()){
                return view('hotel.view_booking_error',compact('booking'));
            } else {
                 // detalles hotel
                foreach($booking->getNodes("RESERVATION",false) as $b){
                    $hotelId = $b['building_id'];
                }
                $xml->servicio = "200";
                $param = '<PARAMETERS language="2" building_id="'.$hotelId.'"></PARAMETERS>'; 
                //dd($param);
                $xml->parametros = $param;
                //dd($xml->parametros);
                $hotel = new XmlParser($xml->getString());
                return view('hotel.view_booking',compact('booking','hotel','reserva','locata','fecha'));
            }
        }
        catch(Exception $e) {
            $bookingError = $e->getMessage();
            return false;
        }
    }

    public function spanishDate() {
        $fecha = [
                 'dia' => ['domingo','lunes','martes','miercoles','jueves','viernes','sabado',],
                 'mes' => ['enero','febrero','marzo','abril','mayo','junio','julio',
                          'agosto','septiembre','octubre','noviembre','diciembre']
                ];
        return $fecha;
    }
}
