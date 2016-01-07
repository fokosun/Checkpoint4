@extends('layout')
@section('title', Auth::user()->fullname . ' | edit profile' )
@section('content')
<div class="container-fluid">
    <div class="login-box">
    @include('pages.alert')
        <div class="login-box-body">
            <div class="text-center spacer text-capitalize">
                <h1>Edit my profile</h1>
                <img src="{{ Auth::user()->avatar }}" class="img-circle" width="150" height="auto">
                <br>
            </div>
            <form action="{{ route('postUpdateUserProfile') }}" method="POST"
                    enctype="multipart/form-data" files="true">
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <input type="file" class="form-control" name="avatar" accept="image/*">
                    <span class="fa fa-camera form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input value="{{ Auth::user()->fullname }}" type="text" class="form-control" name="fullname">
                    <span class="fa fa-pencil form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input value="{{ Auth::user()->occupation }}" type="text" class="form-control" name="occupation">
                    <span class="fa fa-pencil form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <input type="submit" value ="save" class="btn btn-primary btn-block btn-flat" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
