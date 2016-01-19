<header class="main-header">
    <nav class="navbar">
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
                        <a href="https://github.com/andela-fokosun/Checkpoint4" target="_blank">
                            <i class="fa fa-code"></i> &nbsp; <strong>Fork/Clone</strong>
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>

                    @if (Auth::guest())
                    <li>
                        <a href="#" data-toggle="modal" data-target="#gettingstarted">
                            <i class="fa fa-rocket"></i> &nbsp; <strong>Getting Started</strong>
                        </a>
                    </li>
                    @else
                    <li></li>
                    @endif
                </ul>
            </div>

            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
            @if (Auth::guest())
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('getRegister') }}"><strong>Register</strong></a></li>
                    <li><a href="{{ route('getLogin') }}"><strong>Log In</strong></a></li>
                </ul>
            @else
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ Auth::user()->avatar }}" class="user-image" alt="">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs text-capitalize"><strong>{{ Auth::user()->fullname }}</strong>&nbsp;
                            <i class="fa fa-chevron-down"></i>
                            </span>
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
                                    <a href="/profile/{{ Auth::user()->id }}/edit" title="Edit my profile" class="btn btn-default btn-flat">
                                        <i class="fa fa-pencil fa-fw"></i>
                                    </a>
                                    <a href="{{ route('profile') }}" title="Here, all my stuff goes" class="btn btn-default btn-flat">
                                        <i class="fa fa-bars"></i>&nbsp;My Library</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('getLogout') }}" class="btn btn-default btn-flat">
                                        <i class="fa fa-power-off"></i>&nbsp;Log Out</a>
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
@include('modals.gettingstarted')
