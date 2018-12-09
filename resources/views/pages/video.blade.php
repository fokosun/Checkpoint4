@extends('layout')
@section('title', Auth::user()->fullname . ' | watch video' )
@section('content')
    <div class="container">
        <div class="row">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{ $video[0]->url }}" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
        <div class="row">
            <h3>{{ $video[0]->title }}</h3>
        </div>
        <div class="row">
            <span>{{ number_format(1926, 0 , '.' , ',') }} views</span>
        </div>
    </div>
@endsection
