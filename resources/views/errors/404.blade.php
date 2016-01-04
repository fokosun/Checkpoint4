@extends('layout')
@section('title', 'Page Not Found')
@section('content')
<div>
    <section class="content">
        <div class="error-page">
        <br><br>
            <h2 class="headline text-red">404</h2>
            <div class="error-content">
                <h3>
                    <i class="fa fa-warning text-red"></i>
                        Oops! Page not found.
                </h3>
                <p>
                    Sorry, the page you are looking for may have moved
                    or does not exist. Click <a href="{{ URL::to('/') }}">here</a> togo back home
                </p>
                <form class="search-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" name="submit" class="btn btn-warning btn-flat">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
