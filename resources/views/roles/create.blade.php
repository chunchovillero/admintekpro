@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>CREAR ROL</h1>
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

{{ Form::open(['route' => 'roles.store']) }}

@include('roles.partials.form')

{{ Form::close() }}

@stop