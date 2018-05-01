<?php

namespace App\Http\Controllers;

use App\User;
use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Http\Request\UsuarioRequest;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\Roleuser;
use Caffeinated\Shinobi\Models\Permission;

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
        activity()->log('Vio usuarios');
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
    public function update(Request $request, User $user)
    {
         // dd($empresa, $request);

     $data = $this->validate($request, 
        [
            'nombre_completo'=>'required|min:3',
            'password' => '',
            'repassword' => 'required_with:password|same:password'      
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

        // dd($empresa->name); 

     $usuario =  User::find($user->id);
     $usuario->name = $request->nombre_completo;
     if($request->password != ""){
        $usuario->password =  Hash::make($request->password);
    }

    $usuario->save();

    activity()->log('Actualizó su perfil');
    return redirect('perfil/'.$user->id)->with('success', 'Se ha editado el perfil');
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

    public function perfil($id){

        activity()->log('Vio su perfil');
        $latestActivities = Activity::where('causer_id',$id)->latest()->limit(100)->get();
        $empresas = Empresa::get();
        $perfil = User::where('id',$id)->with('empresas')->with('roles')->first();

        $listrol = array();
        foreach ($perfil->roles as $rol) {
            array_push($listrol,$rol->id);
        }
        $roles = Role::with('permisos')->whereIn('id', $listrol)->get();
        $permisos = Permission::get();

        return view('perfil/index', compact('perfil','latestActivities','empresas','permisos','roles'));
    }

    public function asignar($id)
    {
        $perfil = User::where('id',$id)->with('empresas')->with('roles')->first();

        $listrol = array();
        foreach ($perfil->roles as $rol) {
            array_push($listrol,$rol->id);
        }
        $roles = Role::with('permisos')->get();
        $permisos = Permission::get();
        return view('usuarios/asignar', compact('perfil','roles','permisos'));
    }

    public function asignarstore(Request $request, $id)
    {
        $delete = Roleuser::where('user_id', $id)->delete();
        foreach ($request->roles as $roles) {
            $asignar=new Roleuser();
            $asignar->role_id = $roles;
            $asignar->user_id = $id;
            $asignar->save();  
        }
        
        
        return redirect('asignar/'.$id)->with('success', 'Se han asignado los roles');
    }
}
