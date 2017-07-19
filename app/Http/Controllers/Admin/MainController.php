<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Reservas;
use App\Tour;
use App\Ofertas;
use App\Procentajes;
use Carbon\Carbon;
class MainController extends Controller
{
    private $agencias;
    private $reservas;
    private $tour;
    private $ofertas;
    private $procentajes;

    public function __construct(User $user, Reservas $reservas, Tour $tour, Ofertas $ofertas,
        Procentajes $procentajes)
    {
        $this->agencias = $user;
        $this->reservas = $reservas;
        $this->tour = $tour;
        $this->ofertas = $ofertas;
        $this->procentajes = $procentajes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
        {
            $user = Auth::user();
            $confirmed = $this->agencias->status(1)->get();
            $unconfirmed = $this->agencias->status(0)->get();
            $reservas = $this->reservas->all();
            $ofertas = $this->ofertas->all();
            $tours = $this->tour->all();
            $procentajes = $this->procentajes->first();

            return view('admin.main', compact('confirmed','unconfirmed','reservas',
                                            'ofertas','tours','procentajes'))
                    ->withMessage($user->name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
