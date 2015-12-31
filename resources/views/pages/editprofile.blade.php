@extends('layout')
@section('title', Auth::user()->username . ' | edit profile' )
@section('content')
<div class="container-fluid">
    <div class="login-box">
    @include('pages.alert')
        <div class="login-box-body">
            <div class="text-center spacer text-capitalize">
                <h1>Edit my profile</h1>
                <img src="{{ Auth::user()->avatar }}" class="img-circle">
                <br>
            </div>
            <form action="#" method="post">
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <input type="file" class="form-control" name="avatar">
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
                        <a href="" class="btn btn-primary btn-block btn-flat">
                            Save
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
