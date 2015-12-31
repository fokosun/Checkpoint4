@extends('auth')
@section('title', 'register')
<div class="container-fluid">
    <div class="login-box">
    @include('pages.alert')
        <div>
            <a href="#" class="login-logo">
                <b>TECH</b>ADEMIA
            </a>
        </div>
        <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>
                <form action="#" method="post">
                    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Full name" name="fullname">
                        <span class="fa fa-user-plus form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Username" name="username">
                        <span class="fa fa-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <select class="form-control" name="occupation">
                            <option name="occupation">Web Developer</option>
                            <option>Software Engineer</option>
                            <option>Network Engineer</option>
                            <option>Others</option>
                        </select>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <span class="fa fa-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <span class="fa fa-unlock-alt form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="terms">
                                        I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
                <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="{{ url('facebook') }}" class="btn btn-block btn-facebook">
                    <i class="fa fa-facebook"></i>
                        Sign in with Facebook
                </a>
                <a href="{{ url('twitter') }}" class="btn btn-block btn-twitter">
                    <i class="fa fa-twitter"></i>
                        Sign in with Twitter
                </a>
                <a href="{{ URL::to('login/github') }}" class="btn btn-block btn-github">
                    <i class="fa fa-github-alt"></i>
                        Sign in with Github
                </a>
            </div>
                <a href="{{ route('getLogin') }}" class="text-center">
                    I already have a membership
                </a>
        </div>
    </div>
</div>
