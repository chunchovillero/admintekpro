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
				<form role="form" method="post" action="{{route('empresas.update'['id' => $empresa->id])}}">
			<div class="box-body">
				<div class="form-group">
					<label for="exampleInputEmail1">Nombre de la empresa</label>
					<input type="hidden" value="{{csrf_token()}}" name="_token" />
					<input type="text" class="form-control" name="nombre" value="{{$empresa->name}}" placeholder="Nombre de la empresa">
				</div>
				<!-- /.box-body -->

				<div class="box-footer">

					<button type="submit" class="btn btn-primary">Crear</button>
				</div>

			</div>
		</form>
			</div>


		</div>

		@stop