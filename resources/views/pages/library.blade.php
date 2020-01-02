@extends('layout')
@section('title', Auth::user()->fullname . ' | my profile' )
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="text-center spacer text-capitalize">
                @if($categories->count() > 0)
                    @foreach($categories as $category)
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-yellow">
                                <div class="inner text-lowercase">
                                    @if( count($category->videos()->where('user_id',Auth::user()->id)->get()) == 1)
                                        <small style="font-size: 20px">
                                            {{count($category->videos()->where('user_id',Auth::user()->id)->get())}} video
                                        </small>
                                    @else
                                        <small style="font-size: 20px">
                                            {{count($category->videos()->where('user_id',Auth::user()->id)->get())}} videos
                                        </small>
                                    @endif
                                    <p class="category">
                                        <a href="/feeds/{{ $category->id }}/category/{{ $category->slug }}" style="color:white" title="view all {{ $category->title }} videos">
                                            {{ $category->title }}
                                        </a>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="text-center">
            @if ($videos->count() > 0)
                <small>my videos</small><br>
            @else
                <i class="fa fa-film"></i> &nbsp; You have no videos in your library!<br>
            @endif
            <a href={{ url() . "/" . Auth::user()->username . "/videos" }} class="small-box-footer">
                Upload new video <i class="fa fa-arrow-circle-up"></i>
            </a>
        </div>
        <section class="content">
            <ul class="timeline">
                <li>
                    <i class="fa fa-video-camera bg-maroon"></i>
                    <div class="timeline-item">
                        <span class="time">
                            <i class="fa fa-clock-o"></i>
                            @if( !is_null($latest) )
                                Last activity:{{ date('F d, Y', strtotime($latest->created_at)) }}
                            @else
                                Last activity: none
                            @endif
                        </span>
                        <h3 class="timeline-header"><a href="#">recent</a> videos</h3>
                        <div class="timeline-body">
                            <div class="row">
                                @if($videos->count() > 0)
                                    @foreach($videos as $video)
                                        <div class="col-sm-6">
                                            <div class="box-header">
                                            </div>
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe class="embed-responsive-item" src="{{ $video->url }}" frameborder="0" allowfullscreen></iframe>
                                            </div>
                                            <div class="box-footer box-comments">
                                                <div class="box-comment col-sm-12">
                                                    <img class="img-square img-sm" src="{{ $video->user->avatar}}" alt="User Image">
                                                    <div class="comment-text">
                                                <span class="username text-capitalize">
                                                    <b>{{ $video->title }}</b>
                                                    <a href="/video/{{ $video->id }}/edit" title="edit video">
                                                        <i class="fa fa-pencil fa-fw"></i>
                                                    </a>
                                                    <a href="/video/{{ $video->id }}/delete" title="edit video">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </span>
                                                        {{ $video->description }}<br>
                                                        <hr>
                                                        <small>you uploaded this video :
                                                            <b>{{ date('F d, Y', strtotime($video->created_at)) }}</b>
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
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>
        </section>
    </div>
    </div>
@endsection
