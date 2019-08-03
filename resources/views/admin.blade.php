@extends('layouts.master')

@section('title')
    Admin Login
@endsection

@section('styles')src/main.css @endsection

@section('section')
    @include('includes.message')
    <form class="form-signin" method="post" action="{{ route('adminlogin') }}">
        <div class="text-center mb-4">
            <img class="mb-4" src="images/ballot.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Admin Portal</h1>
            <p>This portal is strictly for Administrators only. <br>If you are a voter please click <a
                        href="{{ route('welcome') }}">Here </a>to login to Voters portal.</p>
        </div>

        <div class="form-label-group">
            <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address"
                   required=""
                   autofocus="">
            <label for="inputEmail">Email address</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password"
                   required="">
            <label for="inputPassword">Password</label>
        </div>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
        <button class="mt-4 btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

        <div class="mt-4 text-center">
            <small>&copy; 2019 Kwadoskii</small>
        </div>
    </form>

    <script>
        $('.toast').toast('show');
    </script>
@endsection
