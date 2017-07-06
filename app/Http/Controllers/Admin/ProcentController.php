<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Procentajes;
use Carbon\Carbon;
use Validator;

class ProcentController extends Controller
{
    private $procentajes;

    public function __construct(Procentajes $procentajes)
    {
        $this->procentajes = $procentajes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procent = $this->procentajes->first();
        return view('admin.procentajes.index',compact('procent'))->withMessage('');
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
        $procent = $this->procentajes->find($id);

        // con este metodo de validacion evitamos el eror de MethodNotAllowed
        $validation = Validator::make($request->all(), 
            ['agencias' => 'required|numeric',
            'publico'  => 'required|numeric'
        ]);

        // si la validacion falla Laravel intenta redirecionar a la direccion anterior
        // pero  la direccion anterior es admin/procentajes/editar/{id} que espera un
        // metodo POST, sin embargo Laravel manda una peticion GET
        // asi que redireccionamos, con errores, al pagia principal de procentajes
        if ($validation->fails()) {
            return redirect('admin/procentajes')->withErrors($validation->errors());
        }

        // query para el database
        $query = array('agencias'   => $request->input('agencias'),
                       'publico'    => $request->input('publico'),
                       'updated_at' => Carbon::now());
        
        if ($procent->update($query)) {
            return view('admin.procentajes.index',compact('procent'))
                  ->withMessage("Procentajes actualizados corectamente");
        } else {
            return "error";
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
        //
    }
}
