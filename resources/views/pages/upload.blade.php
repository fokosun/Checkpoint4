@extends('layout')
@section('title', Auth::user()->username . ' | upload video' )
@section('content')
<div class="container-fluid">
    <div class="login-box">
    @include('pages.alert')
        <div class="login-box-body">
            <div class="text-center spacer text-capitalize">
                <h1>Upload video</h1>

            </div>
            <form action="#" method="post">
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="video title" name="title">
                    <span class="fa fa-film form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="url" class="form-control" placeholder="youtube embed url e.g. https://www.youtube.com/embed/CY6SdyMr3Ac" name="url">
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
                    <textarea class="form-control" rows="3" placeholder="describe your video here" name="description"></textarea>
                    <span class="fa fa-info form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            Upload
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
