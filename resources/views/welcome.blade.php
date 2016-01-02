@extends('layout')
@section('title', 'TECHADEMIA')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="text-center spacer text-capitalize">
                <h1>192.168.1.1</h1>
                <h1><blockquote>share, collaborate and learn</blockquote></h1>
            </div>
            <section class="content">
            <ul class="timeline">
                <li>
                    <i class="fa fa-video-camera bg-maroon"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> Last activity: 2 days ago</span>
                        <h3 class="timeline-header"><a href="#">Recent</a> videos</h3>
                        <div class="timeline-body">
                            <div class="row">
                                @foreach($videos as $video)
                                <div class="col-sm-6">
                                    <p class="spacer">
                                        <span class="label label-primary pull-right">
                                            {{ $video->category->title}}
                                        </span>
                                    </p>
                                    <div class="embed-responsive embed-responsive-16by9" style="margin:5%;">
                                        <iframe class="embed-responsive-item" src="{{ $video->url }}" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                    <div class="box-footer box-comments">
                                        <div class="box-comment col-sm-12">
                                            <img class="img-square img-sm" src="{{ $video->user->avatar}}" alt="User Image">
                                            <div class="comment-text">
                                                <span class="username">
                                                    <b>{{ $video->title }}</b> by {{ $video->user->username}}
                                                    <span class="badge bg-aqua pull-right">
                                                        <small>
                                                            {{ date('F d, Y', strtotime($video->created_at)) }}
                                                        </small>
                                                    </span>
                                                </span>
                                                {{ $video->description }}
                                            </div>
                                        </div>
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
