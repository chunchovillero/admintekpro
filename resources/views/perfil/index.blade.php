@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')

@stop

@section('content')


<section class="content">
	<div class="row">
		<div class="col-md-3">
			<!-- Profile Image -->
			<div class="box box-primary">
				<div class="box-body box-profile">
					<!-- <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> -->
					<h1 class="text-center">PERFIL</h1>
					<h1 class="profile-username text-center">{{$perfil->name}} 	</h1>

					<p class="text-muted text-center">{{$perfil->cargo}}</p>
					<p class="text-muted text-center">{{$perfil->empresas->name}}</p>

					
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->

			<!-- About Me Box -->
			
			<!-- /.box -->
		</div>
		<!-- /.col -->
		<div class="col-md-9">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#editar_perfil" data-toggle="tab" aria-expanded="false">Editar Perfil</a></li>
					<li class=""><a href="#activity" data-toggle="tab" aria-expanded="true">Actividad</a></li>
					<li class=""><a href="#permisos" data-toggle="tab" aria-expanded="false">Permisos</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane" id="activity">
						

						<div class="box">
							<div class="box-header with-border">
								
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<table class="table table-bordered">
									<tbody><tr>
										<th style="width: 10px">#</th>
										<th>Descripción</th>
										<th>Fecha</th>
										
									</tr>

									@foreach($latestActivities as $actividad)
									<tr>
										<td>{{$actividad->id}}</td>
										<td>{{$actividad->description}}</td>
										<td>{{$actividad->created_at}}</td>
										
									</tr>
									@endforeach
								</tbody></table>
							</div>
							<!-- /.box-body -->
							<!-- <div class="box-footer clearfix">
								<ul class="pagination pagination-sm no-margin pull-right">
									<li><a href="#">«</a></li>
									<li><a href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">»</a></li>
								</ul>
							</div> -->
						</div>
					</div>
					<!-- /.tab-pane -->
					<div class="tab-pane active" id="editar_perfil">
						@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach 
							</ul>
						</div><br />
						@endif

						@if(\Session::has('success'))
						<div class="alert alert-success">
							{{\Session::get('success')}}
						</div>
						@endif
						<form role="form" method="post" action="{{route('users.update',['id' => $perfil->id])}}">
							<input name="_method" type="hidden" value="PUT">
							<div class="box-body">
								<div class="form-group col-sm-6">
									<input type="hidden" value="{{csrf_token()}}" name="_token" />
									<label for="nombre_completo">Nombre completo</label>
									<input type="text" value="{{$perfil->name}}" class="form-control" name="nombre_completo" placeholder="Nombre completo">

								</div>

								
								

								<div class="form-group col-sm-6">
									<label for="-email_usuariopassword">Contraseña</label>
									<span>Omitir para no cambiarla</span>
									<input type="password" class="form-control" name="password" placeholder="Ingrese Contraseña">
								</div>

								<div class="form-group col-sm-6">
									<label for="repassword">Repita contraseña</label>
									<input type="password" class="form-control" name="repassword" placeholder="Email de usuario">
								</div>

								<div class="form-group col-sm-12">
									<div class="box-footer">

										<button type="submit" class="btn btn-primary">Editar</button>
									</div>
								</div>

								<!-- /.box-body -->


							</div>
						</form>
					</div>
					<!-- /.tab-pane -->

					<div class="tab-pane" id="permisos">
						<div class="box box-solid">
							@foreach($roles as $rol)
							<div class="box-body">
								<div class="box-group" id="accordion">
									<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
									<div class="panel box box-primary">
										<div class="box-header with-border">
											<h4 class="box-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#{{$rol->id}}" aria-expanded="false" class="collapsed">
													{{$rol->name}}
												</a>
											</h4>
										</div>
										<div id="{{$rol->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
											<div class="box-body">
												<ul>
													@if($rol->id==1)

														@foreach($permisos as $perm)
														<li>{{$perm->name}}</li>
														@endforeach

													@endif

													@foreach($rol->permisos as $permiso)
														<li>{{$permiso->name}}</li>
													@endforeach
												</ul>
											</div>
										</div>


									</div>
								</div>

								<!-- /.box-body -->
							</div>
							@endforeach
						</div>
						<!-- /.tab-pane -->
					</div>
					<!-- /.tab-content -->
				</div>
				<!-- /.nav-tabs-custom -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->


	</div>
</section>
@stop