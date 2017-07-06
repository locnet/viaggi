<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ofertas;
use App\Zonas;
use App\Destinos;
use Carbon\Carbon;
use Validator;

class OfertasController extends Controller
{
    private $ofertas;
    private $zonas;
    private $destinos;

    function __construct(Ofertas $ofertas, Zonas $zonas, Destinos $destinos)
    {
        $this->ofertas = $ofertas;
        $this->zonas = $zonas;
        $this->destinos = $destinos;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ofertas = $this->ofertas->get();
        
        return view('admin.ofertas.index', compact('ofertas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ofertas = $this->ofertas->get();
        $zonas = [];
        $destinos = $this->destinos->lists('NombreDestino','IdDestino')->sort();
        $idZonas = $this->zonas->all();
        return view('admin.ofertas.new', compact('zonas','ofertas','destinos','idZonas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            ['titulo'          => 'required',
             'texto'           => 'required',
             'precio_agencias' => 'required|numeric',
             'precio_publico'  => 'required|numeric',
             'alojamiento'     => 'required',
             'hotel_id'        => 'required|numeric',
             'start'           => 'required',
             'fin'             => 'required',
             'pdf'             => 'required',
             'foto'            => 'image|required|mimes:jpeg,png,jpg,gif,svg|max:4096'
            ]);

        if ($validator->fails()) {            
            return redirect('admin/ofertas/nueva')->withErrors($validator->errors());
        } else {
            $query = ['titulo'          => $request->input('titulo'),
                      'texto'           => $request->input('texto'),
                      'precio_agencias' => $request->input('precio_agencias'),
                      'precio_publico'  => $request->input('precio_publico'),
                      'alojamiento'     => $request->input('alojamiento'),
                      'hotel_id'        => $request->input('hotel_id'),
                      'start'           => $request->input('start'),
                      'fin'             => $request->input('fin') ];
            // fichero pdf
            if (!empty($request->file('pdf')) ) {
                $file = $request->file('pdf')->getClientOriginalName();                
                
                if ($request->file('pdf')->move('admin/pdf', $file)) {
                    $query['pdf'] = $file;
                }
                
            } 

            // foto
            if (!empty($request->file('foto'))) {
                $foto = $request->file('foto')->getClientOriginalName();

                if ($request->file('foto')->move('admin/images',$foto)) {
                    $query['foto'] = $foto;
                }

            }
            
            if ( Ofertas::firstOrCreate($query )) {
                return view('admin.ofertas.success_message')
                    ->with('success',true)
                    ->with('message'," creada ");
            } else {
                return view('admin.ofertas.success_message')
                    ->with('success',false)
                    ->with('message'," creada ");
            }
        }
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
        $oferta = $this->ofertas->find($id);
        $zonas = [];
        $destinos = $this->destinos->lists('NombreDestino','IdDestino')->sort();
        $idZonas = $this->zonas->all();
        return view('admin.ofertas.edit', compact('zonas','oferta','destinos','idZonas'));
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
        $oferta = $this->ofertas->find($id);

        $validator = Validator::make($request->all(),
            ['titulo'          => 'required',
             'texto'           => 'required',
             'precio_agencias' => 'required|numeric',
             'precio_publico'  => 'required|numeric',
             'alojamiento'     => 'required',
             'hotel_id'        => 'required|numeric',
             'start'           => 'required',
             'fin'             => 'required',
             'foto'            => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096'
            ]);
        
         if ($validator->fails()) {            
            return redirect('admin/ofertas/editar/'.$id)->withErrors($validator->errors());
        } else {
            $query = ['titulo'          => $request->input('titulo'),
                      'texto'           => $request->input('texto'),
                      'precio_agencias' => $request->input('precio_agencias'),
                      'precio_publico'  => $request->input('precio_publico'),
                      'alojamiento'     => $request->input('alojamiento'),
                      'hotel_id'        => $request->input('hotel_id'),
                      'start'           => $request->input('start'),
                      'fin'             => $request->input('fin') ];

            // fichero pdf
            if (!empty($request->file('pdf')) ) {
                $file = $request->file('pdf')->getClientOriginalName();                
                
                if ($request->file('pdf')->move('admin/pdf', $file)) {
                    $query['pdf'] = $file;
                }
                
            } 

            // foto
            if (!empty($request->file('foto'))) {
                $foto = $request->file('foto')->getClientOriginalName();

                if ($request->file('foto')->move('admin/images',$foto)) {
                    $query['foto'] = $foto;
                }

            }
        }

            // actualizamos
            if ($oferta->update($query)) {
                return redirect('admin/ofertas');
            } else {
                return "Error";
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ofertas = $this->ofertas->get();
        $tour = Ofertas::find($id);

        if ($tour->delete()) {
            return redirect('admin/ofertas');
        }
    }
}
