<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Destinos;
use App\Zonas;
use App\Tour;
use Carbon\Carbon;
use Storage;
use Session;

class CreateTourController extends Controller
{

    private $destinos;
    private $tour;
    private $zonas;
    function __construct(Destinos $destinos, Tour $tour, Zonas $zonas){
        $this->destinos = $destinos;
        $this->tour = $tour;
        $this->zonas = $zonas;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = $this->tour->orderBy('updated_at')->get();
        return view('admin.tours.index',compact('tours'));
    }

    /**
     * Para crear un nuevo tour necesitamos pasar por dos formularios
     * debido a que el numero de dias y hoteles puede ser cualquiera
     * El formulario del view creat_tour nos manda a la ruta /admin/tours/intermedio
     * @return \Illuminate\Http\Response
     */
    public function stepOne()
    {
        $destinos = $this->destinos->lists('NombreDestino','IdDestino')->sort();

        return view('admin.tours.create_tour')->with('destinos',$destinos);
    }

    /**
    * No podemos cargar directamente el view del segundo formulario por que 
    * si la validacion falla nos manda de vuelta con un metodo POST y 
    * salta una excepcion MethodNotAllowedHttpExcepcion
    * La solucion es poner un paso intermedio que no hace mas que coger
    * los datos del primer paso, guardarlos en la session, y recuperar en el 
    * tercer paso
    * @param \Illuminate\Http\Request $request
    */
    public function intermedio(Request $request) {
        $validate = $this->validate($request, [
            'titulo'        => 'required',
            'destino'       => 'required',
            'descripcion'   => 'required',
            'start'         => 'required|date',
            'fin'           => 'required|date',
            'dias'          => 'required|numeric',
            'hoteles'       => 'required|numeric',
            ]);
        // si el primer paso valida pasamos al segundo paso
        $data = $request->input();
        return view('admin.tours.paso_intermedio',compact('data'));
    }
    /**
    *
    * @param  \Illuminate\Http\Request  $request
    */
    public function stepTwo(Request $request)
    {
        // datos formulario paso uno
        $data = Session::get('firstStepData');
        $destinos = $this->destinos->lists('NombreDestino','IdDestino')->sort();
        $zonas = $this->zonas->lists('NombreZona','IdZona');
        $idZonas = $this->zonas->all();
        return view('admin.tours.step_two',compact('data','destinos','zonas','idZonas'));
    }

    
    /**
     * Guarda un nuevo tour en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // datos formulario paso uno
        $firstStepData = Session::get('firstStepData');
        // reglas validacion
        $rules = array(
            'pdfa'          => 'required',
            'foto'          => 'image|required|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'precio'        => 'required|numeric',
            'preciopublico' => 'required|numeric');
        // dias
        $dias = $firstStepData['dias'];
        for ($i = 1; $i <= $dias; $i++) {
            $rules['dia'.$i] = 'required';
        }

        // hoteles y id hoteles
        $hoteles = $firstStepData['hoteles'];
        for ($i=1; $i <= $hoteles; $i++) {
            $rules['hotel'.$i] = 'required';
            $rules['idhotel'.$i] = 'required|numeric';

        }
        $validate = $this->validate($request, $rules);
        
        $query = array(
            'titulo'         => $firstStepData['titulo'],
            'destino'        => $firstStepData['destino'],
            'descripcion'    => $firstStepData['descripcion'],
            'start'          => $firstStepData['start'],
            'fin'            => $firstStepData['fin'],
            'hoteles'        => $firstStepData['hoteles'],
            'precio'         => $request->input('precio'),
            'preciopublico'  => $request->input('preciopublico'),
            'visible'        => $request->input('visibility'),
            'updated_at'     => Carbon::now()
        );
        // array con los dias del tour
        $d = array();
        for ($i=0;$i < $dias; $i++) {
            $d[$i] = $request->input('dia'.($i+1));
        }
        $d = implode('&',$d);        
        $query['dias'] = $d;        

        // array con los hoteles y los id's de los hoteles
        $h = array();
        $idh = array();
        for ($i=0;$i < $hoteles; $i++) {
            $h[$i] = $request->input('hotel'.($i+1));
            $idh[$i] = $request->input('idhotel'.($i+1));
        }
        $h = implode('&',$h);
        $query['hoteles'] = $h;
        $idh = implode('&',$idh);
        $query['idhoteles'] = $idh;

        // fichero pdf
        if (!empty($request->file('pdfa')) ) {
            $file = $request->file('pdfa')->getClientOriginalName();                
            
            if ($request->file('pdfa')->move('admin/pdf', $file)) {
                $query['pdfa'] = $file;
            }
            
        } 

        // foto
        if (!empty($request->file('foto'))) {
            $foto = $request->file('foto')->getClientOriginalName();

            if ($request->file('foto')->move('admin/images',$foto)) {
                $query['foto'] = $foto;
            }

        }
        
        // visibilidad en primera pagina
        $query['visible'] = $request->input('visibility') != null ? "true" : "false";

        if (Tour::firstOrCreate($query)) {
            return view('admin.tours.success_message')
                    ->with('success',true)
                    ->with('message'," creado ");
        } else {
            return view('admin.tours.success_message')
                    ->with('success',false)
                    ->with('message'," creado ");
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
        $tour = $this->tour->find($id);
        $destinos = $this->destinos->lists('NombreDestino','IdDestino')->sort();
        $zonas = $this->zonas->lists('NombreZona','IdZona');
        $idZonas = $this->zonas->all();
        return view('admin.tours.edit_tour',compact('tour','destinos', 'zonas','idZonas'));

    }

    /**
     * Editar tour
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $destinos = $this->destinos->get();
        $tour = $this->tour->find($id);
        
        $validate = $this->validate($request, [
            'titulo'        => 'required',
            'destino'       => 'required',
            'descripcion'   => 'required',
            'start'         => 'required|date',
            'fin'           => 'required|date',
            'dias'          => 'required|numeric',
            'hoteles'       => 'required|numeric',
            'foto'          => 'image',
            'precio'        => 'required|numeric',
            'preciopublico' => 'required|numeric'
            ]);

        $query = array(
            'titulo'         => $request->input('titulo'),
            'destino'        => $request->input('destino'),
            'descripcion'    => $request->input('descripcion'),
            'start'          => $request->input('start'),
            'fin'            => $request->input('fin'),
            'hoteles'        => $request->input('hoteles'),
            'precio'         => $request->input('precio'),
            'preciopublico'  => $request->input('preciopublico'),
            'visible'        => $request->input('visibility'),
            'updated_at'     => Carbon::now()
            );
        
        // array con los dias del tour
        $dias = array();
        for ($i=0;$i < $request->input('dias'); $i++) {
            $dias[$i] = $request->input('dia'.($i+1));
        }
        $dias = implode('&',$dias);        
        $query['dias'] = $dias;

        // array con los hoteles y los id's de los hoteles
        $hoteles = array();
        $idhoteles = array();
        for ($i=0;$i < $request->input('hoteles'); $i++) {
            $hoteles[$i] = $request->input('hotel'.($i+1));
            $idhoteles[$i] = $request->input('idhotel'.($i+1));
        }
        $hoteles = implode('&',$hoteles);
        $query['hoteles'] = $hoteles;
        $idhoteles = implode('&',$idhoteles);
        $query['idhoteles'] = $idhoteles;

        // fichero pdf
        if (!empty($request->file('pdfa')) ) {
            $file = $request->file('pdfa')->getClientOriginalName();                
            
            if ($request->file('pdfa')->move('admin/pdf', $file)) {
                $query['pdfa'] = $file;
            }
            
        } 

        // foto
        if (!empty($request->file('foto'))) {
            $foto = $request->file('foto')->getClientOriginalName();

            if ($request->file('foto')->move('admin/images',$foto)) {
                $query['foto'] = $foto;
            }

        }
        
        // visibilidad en primera pagina
        $query['visible'] = $request->input('visibility') != null ? "true" : "false";
        
        if ($tour->update($query)) {
            return view('admin.tours.success_message')
                    ->with('success',true)
                    ->with('message'," editado ");
        } else {
            return view('admin.tours.success_message')
                    ->with('success',false)
                    ->with('message'," editado ");
        }
        //Tour::create(['titulo' => $input['titulo']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tour = Tour::find($id);

        if ($tour->delete()) {
            return view('admin.tours.success_message')
                    ->with('success',true)
                    ->with('message','borrado');
        }
    }

    /**
    *
    */
    public function create(){
        $destinos = $this->destinos->lists('NombreDestino','IdDestino')->sort();

        return view('admin.tours.create_tour')->with('destinos',$destinos);
    }

    
}
