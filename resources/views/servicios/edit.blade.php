@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div><br />
@endif



<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Editar Servicio</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<form role="form" method="post" action="{{route('servicios.update',['id' => $servicio->id])}}">
		<div class="box-body">
			<div class="form-group">
				<input name="_method" type="hidden" value="PUT">
				<label for="exampleInputEmail1">Nombre del servicio</label>
				<input type="hidden" value="{{csrf_token()}}" name="_token" />
				<input type="text" class="form-control" name="name" value="{{$servicio->nombre}}" placeholder="Nombre del servicio">
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Editar</button>
			</div>

		</div>
	</form>
</div>
@stop