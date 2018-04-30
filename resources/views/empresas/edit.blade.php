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
		<h3 class="box-title">Editar Empresa</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<form role="form" method="post" action="{{route('empresas.update',['id' => $empresa->id])}}">
		<div class="box-body">
			<div class="form-group">
				<input name="_method" type="hidden" value="PUT">
				<label for="exampleInputEmail1">Nombre de la empresa</label>
				<input type="hidden" value="{{csrf_token()}}" name="_token" />
				<input type="text" class="form-control" name="name" value="{{$empresa->name}}" placeholder="Nombre de la empresa">
			</div>
			<h3>Seleccione Servicios</h3>
			<div class="form-group">
				@foreach($servicios as $servicio)
				<?php $check=0; ?>
				@foreach($empresaservicio as $empser)

				@if($servicio->id == $empser->servicio_id)
				<?php $check=1; ?>
				@endif

				@endforeach
				<div class="col-md-2">
					<label>
						@if($check==1)
							{{ Form::checkbox('servicios[]', $servicio->id, true) }}
							{{ $servicio->nombre }}
						@else
							{{ Form::checkbox('servicios[]', $servicio->id, null) }}
							{{ $servicio->nombre }}
						@endif
						<em></em>
					</label>
				</div>
				@endforeach

				<!-- /.box-body -->

				<div class="box-footer" style="clear: both;">

					<div class="box-footer">

						<button type="submit" class="btn btn-primary">Crear</button>
					</div>

				</div>
			</form>
		</div>
		@stop