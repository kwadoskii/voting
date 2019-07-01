@extends('layouts.master')

@section('title')
    Admin
@endsection

@section('section')
    <form class="form-signin" method="post" action="{{ route('adminlogin') }}">
        <div class="text-center mb-4">
            <img class="mb-4" src="images/ballot.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Admin Portal</h1>
            <p>This portal is strictly for Administrators only. <br>If you are a voter please click <a href="#">Here </a> to login to the Voting portal.</a></p>
        </div>

        <div class="form-label-group">
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required=""
                   autofocus="">
            <label for="inputEmail">Email address</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
            <label for="inputPassword">Password</label>
        </div>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
        <button class="mt-4 btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

        <div class="mt-4 text-center">
            <small>&copy; 2019 Kwadoskii</small>
        </div>
    </form>
@endsection