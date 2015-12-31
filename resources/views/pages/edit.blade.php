@extends('layout')
@section('title', Auth::user()->username . ' | upload video' )
@section('content')
<div class="container-fluid">
    <div class="login-box">
    @include('pages.alert')
        <div class="login-box-body">
            <div class="text-center spacer text-capitalize">
                <h1>{!! $video->title !!}</h1>
                <br>
            </div>
            <form action="#" method="post">
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="edit video title" name="title">
                    <span class="fa fa-film form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="url" class="form-control" placeholder="edit video url" name="url">
                    <span class="fa fa-link form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <select class="form-control" name="category">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" name="channel">{{$category->title}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group has-feedback">
                    <textarea class="form-control" rows="3" placeholder="edit your video description" name="description"></textarea>
                    <span class="fa fa-info form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <a href="" class="btn btn-primary btn-block btn-flat">
                            Update
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a href="" class="btn btn-primary btn-block btn-flat">
                            Delete
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
