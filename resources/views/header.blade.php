<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="/" class="navbar-brand"><b>TECH</b>ADEMIA</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="https://github.com/andela-fokosun/Checkpoint4">
                            <i class="fa fa-github"></i> &nbsp; It's open-sourced
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#gettingstarted">
                            <i class="fa fa-rocket"></i> &nbsp; Getting Started
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
            @if (Auth::guest())
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('getRegister') }}">REGISTER</a></li>
                    <li><a href="{{ route('getLogin') }}">LOG IN</a></li>
                </ul>
            @else
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ Auth::user()->avatar }}" class="user-image" alt="">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs text-capitalize">{{ Auth::user()->username }}</span>
                        </a>
                        <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                            <li class="user-header text-capitalize">
                                <img src="{{ Auth::user()->avatar }}" class="img-circle" alt="{{ Auth::user()->fullname }}">
                                <p>
                                    {{ Auth::user()->fullname }} <br>
                                    <small>{{ Auth::user()->occupation }}</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Profile</a>
                                    <a href="/profile/{{ Auth::user()->username }}/edit" title="edit my profile" class="btn btn-default btn-flat">
                                        <i class="fa fa-pencil fa-fw"></i>
                                    </a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('getLogout') }}" class="btn btn-default btn-flat">Log out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </nav>
</header>
<!-- Modal -->
<div class="modal fade" id="gettingstarted" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-rocket"></i> &nbsp; Getting Started</h4>
            </div>
            <div class="modal-body">
                <p>Techademia is about sharing, collaborating and learning. Get a chance to see cool tech videos from across the world in one place, get a chance to share your own tech videos. Did i mention that you can have your own library? Yes, you can manage your own videos, upload a video, delete a video or even change the title if you dont like it anymore. How about viewing profile of other users?? Cool stuff huh?</p>
                <small>
                    Get started by hitting the <a href="">register</a> or <a href="">login button</a>. It's at the top right corner of your screen
                </small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok, cool!</button>
            </div>
        </div>
    </div>
</div>
