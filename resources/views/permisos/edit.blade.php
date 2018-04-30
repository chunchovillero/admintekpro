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
		<h3 class="box-title">Ingresar Empresa</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->


	<form role="form" method="post" action="{{route('permisos.update',['id' => $permiso->id])}}">
		<input name="_method" type="hidden" value="PUT">
			<div class="box-body">
				<div class="form-group">
					<label for="exampleInputEmail1">Nombre del permiso</label>
					<input type="hidden" value="{{csrf_token()}}" name="_token" />
					<input type="text" value="{{$permiso->name}}" class="form-control" name="nombre" placeholder="Nombre del permiso">
				</div>

				<div class="form-group">
					<label for="slug">Slug</label>
					<input type="text" value="{{$permiso->slug}}" class="form-control" name="slug" placeholder="Slug">
				</div>

				<div class="form-group">
					<label for="exampleInputEmail1">Descripción</label>
					<input type="text" value="{{$permiso->description}}" class="form-control" name="description" placeholder="Descripción">
				</div>
				<!-- /.box-body -->

				<div class="box-footer">

					<button type="submit" class="btn btn-primary">Editar Permiso</button>
				</div>

			</div>
		</form>
</div>
@stop