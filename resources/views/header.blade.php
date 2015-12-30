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
                        <a href="#">
                            Clone this project
                            <span class="sr-only">(current)</span>
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
                            <img src="{{ Auth::user()->avatar }}" class="user-image" alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs text-capitalize">{{ Auth::user()->fullname }}</span>
                        </a>
                        <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                            <li class="user-header text-capitalize">
                                <img src="{{ Auth::user()->avatar }}" class="img-circle" alt="{{ Auth::user()->fullname }}">
                                <p>
                                    {{ Auth::user()->fullname }} <br>
                                    {{ Auth::user()->occupation }}
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Profile</a>
                                    <a href="#" title="go to settings"><i class="fa fa-gear fa-1x"></i></a>
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
