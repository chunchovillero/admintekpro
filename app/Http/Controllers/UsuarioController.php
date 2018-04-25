<?php

namespace App\Http\Controllers;

use App\User;
use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Http\Request\UsuarioRequest;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::get();
        $usuarios = User::with('empresas')->get();

        activity()->log('Vio los usuarios');

        // dd($usuarios);
        
        return view('usuarios/index', compact('usuarios', 'empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        activity()->log('Vio usuariose');
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        activity()->log('Registo Usuario de nombre: '.$request->nombre_completo.'con email: '.$request->email);
        $usuario = new User();
        $data = $this->validate($request, 
            [
                'nombre_completo'=>'required|min:3',
                'email_usuario'=>'required|email',
                'password' => 'required|min:6',
                'repassword' => 'required_with:password|same:password|min:6'      
            ],
            [
                'nombre_completo.required' => 'El campo nombre completo es obligatorio',
                'nombre_completo.min' => 'El campo nombre debe tener 6 caracteres como minimo',
                'email.required' =>'El campo Email es obligatorio',
                'email.email' => 'El campo Email debe ser un email válido',
                'password.required' => 'El campo Contraseña es obligatorio',
                'password.min' => 'El campo Contraseña debe tener 6 caracteres como minimo',
                'repassword.required' => 'El campo Repita Contraseña es obligatorio',
                'repassword.min' => 'El campo Repita Contraseña debe tener 6 caracteres como minimo',  
            ]
        );

        $usuario->name = $request->nombre_completo;
        $usuario->email = $request->email_usuario;
        $usuario->password = bcrypt($request->password);
        $usuario->empresas_id = $request->empresa;
        $usuario->save();

        return redirect('usuarios')->with('success', 'Se ha creado el usuario '.$request->nombre_completo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::find($id);

        return view('usuarios.show', compact('user'));
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

    public function perfil(){
        $perfil = User::where('id',auth()->user()->id)->with('empresas')->first();
        return view('perfil/index', compact('perfil'));
    }
}
