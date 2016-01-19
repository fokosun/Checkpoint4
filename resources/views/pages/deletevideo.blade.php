@extends('layout')
@section('title', Auth::user()->username . ' | delete video' )
@section('content')
<div class="container-fluid">
    <div class="login-box">
    @include('pages.alert')
        <div class="login-box-body">
            <div class="text-center spacer text-capitalize">
                <h1>{!! $video->title !!}</h1>
                <br>
            </div>
            <form action="{{ route('video.delete', $video->id )}}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-xs-6">
                        <input type="submit" value ="Delete" class="btn btn-primary btn-block btn-flat" />
                    </div>
                    <div class="col-xs-6">
                        <a href="/user/profile" class="btn btn-primary btn-block btn-flat"><i class="fa fa-arrow-left"></i> go back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
