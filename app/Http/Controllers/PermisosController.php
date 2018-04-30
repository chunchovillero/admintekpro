<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Permission;

class PermisosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $permisos = Permission::get();
     return view('permisos.index', compact('permisos'));
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
        $permiso = new Permission();
        $data = $this->validate($request, [
            'nombre'=>'required', 
            'slug'=>'required',        
        ]);

        $permiso->name = $request->nombre;
        $permiso->slug = $request->slug;
        $permiso->description = $request->description;
        $permiso->save();

        return redirect('permisos')->with('success', 'Se ha creado lel permiso '.$request->nombre);
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
        $permiso = Permission::find($id);
        return view('permisos.edit', compact('permiso'));
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
        $data = $this->validate($request, [
            'nombre'=>'required', 
            'slug'=>'required',        
        ]);

        // dd($empresa->name); 

        $permiso =  Permission::find($id);
        $permiso->name = $request->nombre;
        $permiso->slug = $request->slug;
        $permiso->description = $request->description;
        
        $permiso->save();

        activity()->log('Creo el permiso '. $request->nombre);
        return redirect('permisos')->with('success', 'Se ha editado el permiso '. $request->nombre);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permiso = Permission::find($id);
        $permiso->delete();

        return redirect('permisos')->with('success', 'Se ha eliminado el permiso "'.$permiso->name.'"');
    }
}
