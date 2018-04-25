<?php

namespace App\Http\Controllers;

use App\Empresa;
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

        $empresas = Empresa::get();
        return view('empresas/index', compact('empresas'));
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
    public function edit(Empresa $empresa)
    {
        return view('empresas.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
         // dd($empresa, $request);

        $data = $this->validate($request, [
            'name'=>'required'
        ]);

        // dd($empresa->name); 

        $emp =  Empresa::find($empresa->id);
        $emp->name = $request->name;
        $emp->save();

         return redirect('empresas')->with('success', 'Se ha editado la empresa "'.$empresa->name.'" a "'.$request->name.'"');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        $emp = Empresa::find($empresa->id);
        $emp->delete();

        return redirect('empresas')->with('success', 'Se ha eliminado La empresa "'.$empresa->name.'"');
    }
}
