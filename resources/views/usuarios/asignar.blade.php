@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<h1>Asignar Roles al usuario {{$perfil->name}}</h1>
{{ Form::open(['route' => ['asignar.store',$perfil->id]]) }}
<div class="form-group">
	<ul class="list-unstyled">
		@foreach($roles as $rol)
	    <li>
	        <label>
	        {{ Form::checkbox('roles[]', $rol->id, null) }}
	        {{ $rol->name }}
	        <em>({{ $rol->description }})</em>
	        </label>
	    </li>
	    @endforeach
    </ul>
</div>
<div class="form-group">
	{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>
{{ Form::close() }}

@stop