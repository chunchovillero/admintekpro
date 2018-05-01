@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<h1>Asignar Roles al usuario {{$perfil->name}}</h1>

@if(\Session::has('success'))
						<div class="alert alert-success">
							{{\Session::get('success')}}
						</div>
						@endif


{{ Form::open(['route' => ['asignar.store',$perfil->id]]) }}
<div class="form-group">
	<ul class="list-unstyled">
		@foreach($roles as $rol)

		<?php $check=0; ?>
		@foreach($perfil->roles as $perfilrol)

		@if($rol->id == $perfilrol->id)
		<?php $check=1; ?>
		@endif

		@endforeach

		<li>
			<label>
				@if($check==1)
				{{ Form::checkbox('roles[]', $rol->id, true) }}
				{{ $rol->nombre }}
				@else
				{{ Form::checkbox('roles[]', $rol->id, null) }}
				{{ $rol->nombre }}
				@endif
				<em>{{ $rol->name }}</em>
				<em>({{ $rol->description }})</em>
			</label>
		</li>
		<ul class="list-inline" style="margin-left: 30px">
			@if($rol->id==1)

			@foreach($permisos as $perm)
			<li>{{$perm->name}} /</li>
			@endforeach

			@endif

			@foreach($rol->permisos as $permiso)
			<li>{{$permiso->name}} /</li>
			@endforeach
		</ul>
		@endforeach


	</ul>
</div>
<div class="form-group">
	{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>
{{ Form::close() }}

@stop