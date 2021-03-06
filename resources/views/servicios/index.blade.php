@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')

<div id="crudservicio" class="">

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
			<h3 class="box-title">Ingresar Servicio</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<form role="form" method="post" action="{{route('servicios.store')}}">
			<div class="box-body">
				<div class="form-group">
					<label for="exampleInputEmail1">Nombre del servicio</label>
					<input type="hidden" value="{{csrf_token()}}" name="_token" />
					<input type="text" class="form-control" name="nombre" placeholder="Nombre del servicio">
				</div>
				<!-- /.box-body -->

				<div class="box-footer">

					<button type="submit" class="btn btn-primary">Crear servicio</button>
				</div>

			</div>
		</form>

		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Servicios</h3>
			</div>

			@if(\Session::has('success'))
			<div class="alert alert-success">
				{{\Session::get('success')}}
			</div>
			@endif

			<!-- /.box-header -->
			<div class="box-body">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th style="width: 10px" class="col-xs-2 col-md-1" >#</th>
							<th class="col-xs-2 col-md-7">Nombre</th>
							<th class="col-xs-2 col-md-4">Acciones</th>
						</tr>

						@foreach($servicios as $servicio)
						<tr>
							<td>{{$servicio->id}}</td>
							<td>{{$servicio->nombre}}</td>

							<td>
								<div class="row">
									<!-- <div class="col-xs-4 col-md-4">
										<a href="#" class="btn btn-primary btn-sm active" role="button">Ver</a>
									</div> -->
									<div class="col-xs-4 col-md-4">
										<a href="{{route('servicios.edit',['id' => $servicio->id])}}" class="btn btn-warning btn-sm active" role="button">Editar</a>
									</div>
									<div class="col-xs-4 col-md-4">
										<form action="{{route('servicios.destroy', $servicio->id)}}" method="post">
											{{csrf_field()}}
											<input name="_method" type="hidden" value="DELETE">
											<button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
										</form>
									</div>

								</div>
							</td>
						</tr>
						@endforeach
					</tbody></table>
				</div>
				<!-- /.box-body -->
				<div class="box-footer clearfix">
					<ul class="pagination pagination-sm no-margin pull-right">
						<li><a href="#">«</a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">»</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

@stop