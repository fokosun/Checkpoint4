<div class="row">
    <div class="col-md-12">
    <br><br>
        <div class="spacer hero">
            <h1 class="hero-short">
                <p>Share.Collaborate.Learn</p>
            </h1>
            <h3 class="hero-long">
                Join our growing community of over 5 million users today!
            </h3>
            <div class="text-center getting-started">
                <i class="fa fa-paint-brush"></i>&nbsp;&nbsp;
                <a href="{{ route('getRegister') }}">SIGN UP</a>
            </div>
        </div>
        <div class="row spacer">
            <div class="text-center">
                <h2>Popular videos</h2>
            </div>
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
                        <h3 class="timeline-header"><a href="#">popular videos</a> uploaded</h3>
                        <div class="timeline-body">
                            <div class="row">
                            @if(count($videos) > 0)
                                @foreach($videos as $video)
                                <div class="col-sm-4">
                                    <div class="box-header">
                                        <p class="spacer">
                                            <span class="label label-primary pull-right">
                                                {{ $video->category->title}}
                                            </span>
                                        </p>
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
                                                    <span class="badge bg-aqua pull-right spacersm">
                                                        <small>
                                                            {{ date('F d, Y', strtotime($video->created_at)) }}
                                                        </small>
                                                    </span>
                                                </span>
                                                {{ $video->description }}<br>
                                                <small>upload by: {{ $video->user->fullname}}</small>
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