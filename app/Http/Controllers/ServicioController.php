<?php

namespace App\Http\Controllers;

use App\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $servicios = Servicio::with('empresas')->get();
        return view('servicios/index', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('servicios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $servicios = new Servicio();
        $data = $this->validate($request, [
            'nombre'=>'required',       
        ]);

        $servicios->nombre = $request->nombre;
        $servicios->save();

        return redirect('servicios')->with('success', 'Se ha creado el servicio '.$request->nombre);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit($servicio)
    {
        $servicio=Servicio::where('id',$servicio)->first();
        return view('servicios.edit', compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $servicio)
    {
         // dd($empresa, $request);

        $data = $this->validate($request, [
            'name'=>'required'
        ]);

        // dd($empresa->name); 

        $ser =  Servicio::find($servicio);
        $ser->nombre = $request->name;
        $ser->save();

        return redirect('servicios')->with('success', 'Se ha editado el servicio '.$request->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ser = Servicio::find($id);
        $ser->delete();

        return redirect('servicios')->with('success', 'Se ha eliminado el servicio "'.$ser->nombre.'"');
    }
}
