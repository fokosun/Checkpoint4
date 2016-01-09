<div class="row">
    <div class="col-md-12">
        <div class="hero">
        <div class="hero-text text-center">
            <h1 class="hero-text-large">
                <p>Upload.Organize.Learn</p>
            </h1>
            <h3 class="hero-text-small">
                Join our growing community of <br>over 5 million users today
            </h3>
            <h4 class="text-center">
                upload your own youtube videos <br>and start learning awesome new stuff everyday!
            </h4>
            </div>
            <div class="text-center getting-started">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-flat text-capitalize">Get started already</button>
                  <button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ url('/auth/register') }}">Register</a></li>
                    <li><a href="{{ url('/auth/login') }}">Log In</a>
                    </li><li class="divider"></li>
                    <li><a href="{{ url('/auth/login/facebook') }}"><i class="fa fa-facebook"></i>
                        Sign in with Facebook</a></li>

                    <li><a href="{{ url('/auth/login/twitter') }}"><i class="fa fa-twitter"></i>
                        Sign in with Twitter</a></li>
                    <li><a href="{{ url('/auth/login/github') }}"><i class="fa fa-github-alt"></i>
                        Sign in with Github</a></li>
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
