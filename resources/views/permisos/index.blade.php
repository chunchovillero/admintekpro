@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')

<div id="crudempresa" class="">

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
			<h3 class="box-title">Ingresar Permiso</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<form role="form" method="post" action="{{route('permisos.store')}}">
			<div class="box-body">
				<div class="form-group">
					<label for="exampleInputEmail1">Nombre del permiso</label>
					<input type="hidden" value="{{csrf_token()}}" name="_token" />
					<input type="text" class="form-control" name="nombre" placeholder="Nombre del permiso">
				</div>

				<div class="form-group">
					<label for="slug">Slug</label>
					<input type="text" class="form-control" name="slug" placeholder="Slug">
				</div>

				<div class="form-group">
					<label for="exampleInputEmail1">Descripción</label>
					<input type="text" class="form-control" name="description" placeholder="Descripción">
				</div>
				<!-- /.box-body -->

				<div class="box-footer">

					<button type="submit" class="btn btn-primary">Crear Permiso</button>
				</div>

			</div>
		</form>

		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Permisos</h3>
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
							<th>Nombre</th>
							<th>Slug</th>
							<th>Descripción</th>
							<th>Creado</th>
							<th>Acciones</th>
						</tr>

						@foreach($permisos as $permiso)
						<tr>
							<td>{{$permiso->id}}</td>
							<td>{{$permiso->name}}</td>
							<td>{{$permiso->slug}}</td>
							<td>{{$permiso->description}}</td>
							<td>{{$permiso->created_at}}</td>

							<td>
								<div class="row">
									
									<div class="col-xs-4 col-md-4">
										<a href="{{route('permisos.edit',['id' => $permiso->id])}}" class="btn btn-warning btn-sm active" role="button">Editar</a>
									</div>
									<div class="col-xs-4 col-md-4">
										<form action="{{route('permisos.destroy', $permiso->id)}}" method="post">
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