@extends('layout')
@section('title', Auth::user()->username . ' | edit video' )
@section('content')
<div class="container-fluid">
    <div class="login-box">
    @include('pages.alert')
        <div class="login-box-body">
            <div class="text-center spacer text-capitalize">
                <h1>{!! $video->title !!}</h1>
                <br>
            </div>
            <form action="{{ route('video.update', $video->id )}}" method="post">
            <input type="hidden" name="_method" value="PUT">
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <input value="{!! $video->title !!}" class="form-control edit" name="title">
                    <span class="fa fa-film form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input value="{!! $video->url !!}" type="url" class="form-control edit" name="url">
                    <span class="fa fa-link form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <select class="form-control edit" name="category">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" name="channel">{{$category->title}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group has-feedback">
                    <textarea class="form-control edit" rows="3" name="description">
                        {!! $video->description !!}
                    </textarea>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <input type="submit" value ="update" class="btn btn-primary btn-block btn-flat" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
