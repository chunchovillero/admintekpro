@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>ROLES</h1>
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
	
		

		<div class="box">
			<div class="box-header with-border">
				 @can('roles.create')
                    <a href="{{ route('roles.create') }}" 
                    class="btn btn-sm btn-primary pull-left">
                        Crear
                    </a>
                    @endcan
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
							<th class="col-xs-2 col-md-2">Nombre</th>
							<th class="col-xs-2 col-md-2">Slug</th>
							<th class="col-xs-2 col-md-3">Descripción</th>
							<th class="col-xs-2 col-md-2">Special</th>
							<th class="col-xs-2 col-md-2">Acciones</th>
						</tr>

						@foreach($roles as $rol)
						<tr>
							<td>{{$rol->id}}</td>
							<td>{{$rol->name}}</td>
							<td>{{$rol->slug}}</td>
							<td>{{$rol->description}}</td>
							<td>{{$rol->special}}</td>

							<td>
								<div class="row">
									<div class="col-xs-4 col-md-4">
										@can('roles.show')

										<a href="{{ route('roles.show', $rol->id) }}" 
											class="btn btn-sm btn-primary">
											ver
										</a>

										@endcan
									</div>
									<div class="col-xs-4 col-md-4">
										@can('roles.edit')

										<a href="{{ route('roles.edit', $rol->id) }}" 
											class="btn btn-sm btn-warning">
											editar
										</a>

										@endcan
									</div>
									<div class="col-xs-4 col-md-4">
										{!! Form::open(['route' => ['roles.destroy', $rol->id], 
										'method' => 'DELETE']) !!}
										<button class="btn btn-sm btn-danger">
											Eliminar
										</button>
										{!! Form::close() !!}
									</div>

								</div>
							</td>
						</tr>
						@endforeach
					</tbody></table>
				</div>
				<!-- /.box-body -->

			</div>
		</div>
	</div>
</div>

@stop