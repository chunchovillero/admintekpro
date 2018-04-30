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
			<h3 class="box-title">Ingresar Usuario</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<form role="form" method="post" action="{{route('usuarios.store')}}">
			<div class="box-body">
				<div class="form-group col-sm-6">
					<input type="hidden" value="{{csrf_token()}}" name="_token" />
					<label for="nombre_completo">Nombre completo</label>
					<input type="text" value="{{old('nombre_completo')}}" class="form-control" name="nombre_completo" placeholder="Nombre completo">
					
				</div>

				<div class="form-group col-sm-6">
					<label for="email_usuario">Email</label>
					<input type="email" value="{{old('email_usuario')}}" class="form-control" name="email_usuario" placeholder="Email de usuario">
				</div>

				<div class="form-group col-sm-6">
					<label for="email_usuario">Seleccione Empresa</label>
					<select name="empresa" class="form-control">
						@foreach($empresas as $empresa)
						<option value="{{$empresa->id}}">{{$empresa->name}}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group col-sm-6">
					<label for="-email_usuariopassword">Contraseña</label>
					<input type="password" class="form-control" name="password" placeholder="Ingrese Contraseña">
				</div>

				<div class="form-group col-sm-6">
					<label for="repassword">Repita contraseña</label>
					<input type="password" class="form-control" name="repassword" placeholder="Email de usuario">
				</div>

				<div class="form-group col-sm-12">
					<div class="box-footer">

					<button type="submit" class="btn btn-primary">Crear</button>
				</div>
				</div>

				<!-- /.box-body -->


			</div>
		</form>

		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">USUARIOS</h3>
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
							<th class="col-xs-2 col-md-3">Nombre Completo</th>
							<th class="col-xs-2 col-md-3">Email</th>
							<th class="col-xs-2 col-md-2">Empresa</th>
							<th class="col-xs-2 col-md-3">Acciones</th>
						</tr>

						@foreach($usuarios as $usuario)
						<tr>
							<td>{{$usuario->id}}</td>
							<td>{{$usuario->name}}</td>
							<td>{{$usuario->email}}</td>
							<td>{{$usuario->empresas->name}}</td>

							<td>
								<div class="row">
									<div class="col-xs-4 col-md-4">
										 <a href="{{route('perfil.index', ['id' => $usuario->id])}}" class="btn btn-primary btn-sm active" role="button">Ver</a>
									</div>
									<div class="col-xs-4 col-md-4">
										<a href="{{route('asignar.index',['id' => $usuario->id])}}" class="btn btn-warning btn-sm active" role="button">Asignar</a>
									</div>
									<div class="col-xs-4 col-md-4">
										<form action="{{route('empresas.destroy', $empresa->id)}}" method="post">
											{{csrf_field()}}
											<input name="_method" type="hidden" value="DELETE">
											<button class="btn btn-danger" type="submit">Eliminar</button>
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