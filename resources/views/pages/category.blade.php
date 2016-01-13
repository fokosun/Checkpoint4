@extends('layout')
@section('title', Auth::user()->username . ' | upload video' )
@section('content')
<div class="container-fluid">
    <div class="login-box">
    @include('pages.alert')
        <div class="login-box-body">
            <div class="text-center spacer text-capitalize">
                <h1>create category</h1>
                <br>
            </div>
            <form action="#" method="post">
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="title" name="title">
                    <span class="fa fa-film form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            Create
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
