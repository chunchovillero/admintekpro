@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('profile::_menu')
            </div>
            <div class="col-sm-9">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="panel panel-danger">
                    <div class="panel-heading">Delete Account</div>
                    <div class="panel-body">
                        <form action="{{ route('profile.remove') }}" method="post" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}

                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <p class="lead">Are you sure?</p>
                                    <a href="{{ route('profile') }}" class="btn btn-primary">No, I changed my mind!</a>
                                    <button class="btn btn-danger">Yes, delete my account.</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection