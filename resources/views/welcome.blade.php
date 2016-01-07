@extends('layout')
@section('title', 'TECHADEMIA')
@section('content')
<div class="row">
    <div class="col-md-12">
    <br><br>
        <div class="text-center spacer text-capitalize">
            <h1>192.168.1.1</h1>
            <h1><blockquote>share, collaborate and learn</blockquote></h1>
        </div>
        <section class="content">
            <ul class="timeline">
                <li>
                    <i class="fa fa-video-camera bg-maroon"></i>
                    <div class="timeline-item">
                        <span class="time">
                            <i class="fa fa-clock-o"></i>
                            @if( count($latest) > 0 )
                                Last activity:{{ date('F d, Y', strtotime($latest->created_at)) }}
                            @else
                                Last activity: none
                            @endif
                        </span>
                        <h3 class="timeline-header"><a href="#">videos</a> by everybody</h3>
                        <div class="timeline-body">
                            <div class="row">
                            @if(count($videos) > 0)
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
                                                <span class="username text-capitalize">
                                                    <b>{{ $video->title }}</b>
                                                    <span class="badge bg-red pull-right spacersm">
                                                        <small>
                                                            {{ date('F d, Y', strtotime($video->created_at)) }}
                                                        </small>
                                                    </span>
                                                </span>
                                                {{ $video->description }}<br><br>
                                                <small class="text-capitalize">
                                                    <b>upload by: {{ $video->user->fullname}}</b>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="timeline-item text-center">
                        {!! $videos->render() !!}
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
