@extends('auth')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
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
                                        <iframe class="embed-responsive-item" src="{{ $video->url }}" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </section>
        </div>
    </div>
</div>
@endsection
