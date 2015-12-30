@extends('layout')
@section('title', Auth::user()->username . ' | my profile' )
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="text-center spacer text-capitalize">
                <h1>My videos</h1>
                <a href="{{ route('viewUploadVideoForm') }}">
                    <div class="btn-group">
                        <button type="button" class="btn btn-block btn-warning btn-lg">
                            upload new video
                        </button>
                    </div>
                </a>
            </div>
            <section class="content">
                <ul class="timeline">
                    <li>
                        <i class="fa fa-video-camera bg-maroon"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                            <h3 class="timeline-header"><a href="#">Recent</a> videos</h3>
                            <div class="timeline-body">
                                <div class="row">
                                    @foreach($videos as $video)
                                    <div class="col-sm-4">
                                        <div class="embed-responsive embed-responsive-16by9" style="margin:5%;">
                                            <iframe class="embed-responsive-item" src="{{ $video->url }}" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                        <div style="margin:5%;">
                                            <h5 class="timeline-header h5">
                                                <p class="spacer">
                                                    <a href="#">{{ $video->title }}</a>
                                                    <span class="label label-primary pull-right">{{ $video->category->title}}</span>
                                                </p>
                                            </h5>
                                            <small>{{ $video->description }}</small>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                    </li>
                </ul>
            </section>
        </div>
    </div>
@endsection
