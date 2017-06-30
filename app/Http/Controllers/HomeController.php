<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tour;
use App\Ofertas;
use App\Zonas;
use User;

class HomeController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    private $tour;
    private $ofertas;
    private $zonas;
    function __construct(Tour $tour, Ofertas $ofertas, Zonas $zonas){
        $this->tour = $tour;
        $this->ofertas = $ofertas;
        $this->zonas = $zonas;
    }
    /**
     * Display the home page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = $this->tour->get()->take(3);
        $ofertas = $this->ofertas->get()->take(3);
        return view('landing_page',compact('tours','ofertas'));
    }  
}
