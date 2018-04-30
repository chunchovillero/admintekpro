<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Servicio;
use App\Empresaservicio;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $empresas = Empresa::with('servicios')->get();
        $servicios = Servicio::get();
        return view('empresas/index', compact('empresas', 'servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empresa = new Empresa();
        $data = $this->validate($request, [
            'nombre'=>'required',       
        ]);

        $empresa->name = $request->nombre;
        $empresa->save();

        foreach ($request->servicios as $servicio) {
            $ser=new Empresaservicio();
            $ser->empresa_id = $empresa->id;
            $ser->servicio_id = $servicio;
            $ser->save();
        }

        return redirect('empresas')->with('success', 'Se ha creado la empresa '.$request->nombre);
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
    public function edit($id)
    {
        $empresa=Empresa::where('id',$id)->first();
        $servicios = Servicio::get();
        $empresaservicio = Empresaservicio::where('empresa_id', $id)->get();
        return view('empresas.edit', compact('empresa','servicios', 'empresaservicio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        

        $data = $this->validate($request, [
            'name'=>'required'
        ]);

         // dd($request->name);

        // dd($empresa->name); 

        $emp =  Empresa::find($id);
        $emp->name = $request->name;
        $emp->save();

        $delete = Empresaservicio::where('empresa_id', $id)->delete();

        foreach ($request->servicios as $servicio) {
            $ser=new Empresaservicio();
            $ser->empresa_id = $id;
            $ser->servicio_id = $servicio;
            $ser->save();
        }



        return redirect('empresas')->with('success', 'Se ha editado la empresa "'.$request->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emp = Empresa::find($id);
        $emp->delete();

        return redirect('empresas')->with('success', 'Se ha eliminado La empresa "'.$emp->name.'"');
    }
}
