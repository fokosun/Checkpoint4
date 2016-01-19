<div class="row">
    <div class="col-md-12">
        <div class="hero">
            <div class="hero-text text-center">
                <h1 class="hero-text-large hidden-xs">
                    <p>upload.organize.learn</p>
                </h1>
                <h3 class="hero-text-small h3">
                    Upload your own youtube videos <br>and start learning awesome new stuff everyday!
                </h3>
                <div class="call-to-action">
                    <a href="{{ url('/auth/login/facebook') }}" class="btn btn-facebook fb" name="facebook">
                        <i class="fa fa-facebook-official"></i>&nbsp;&nbsp;Sign in with Facebook
                    </a><br><br>
                    <a href="{{ url('/auth/login/twitter') }}" class="btn btn-twitter fb" name="twitter">
                        <i class="fa fa-twitter"></i>&nbsp;&nbsp;Sign in with Twitter
                    </a><br><br>
                    <a href="{{ url('/auth/login/github') }}" class="btn btn-github fb" name="github">
                        <i class="fa fa-github-alt"></i>&nbsp;&nbsp;Sign in with Github
                    </a>
                </div>
                <div class="spacer">
                    <a href="{{ url('/feeds') }}" class="guest" style="color:#FFFFE9">
                        <br><small>Continue as guest <i class="fa fa-arrow-circle-right"></i></small>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div style="position:fixed;height: 50px;bottom: 0;width: 100%;">
            @include('footer')
        </div>
    </div>
</div>