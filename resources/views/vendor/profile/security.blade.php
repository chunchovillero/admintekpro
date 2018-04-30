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
                <div class="panel panel-default">
                    <div class="panel-heading">Update Password</div>
                    <div class="panel-body">
                        <form action="{{ route('profile.security.store') }}" method="post" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('put') }}

                            <div class="form-group">
                                <label class="control-label col-md-3">Current Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="current_password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">New Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Confirm Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <button class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection