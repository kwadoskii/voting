@extends('layouts.master')

@section('title')
E-Voting Home
@endsection

@section('head')
<link rel="stylesheet" href="{{ URL::to('src/user.css') }}">
@endsection

@section('section')
@include('includes.message')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                <span class="login100-form-title p-b-34">
                    LOGIN
                </span>

                <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-10" data-validate="Type user name">
                    <input id="nin" class="input100" type="text" name="nin" placeholder="NIN">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-10" data-validate="Type password">
                    <input class="input100" type="password" name="pass" id="pass" placeholder="Password">
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <button class="login100-form-btn" type="submit">
                        Sign in
                    </button>
                </div>
            </form>

            <div class="login100-more" style="background-image: url({{URL::to('Ballot-box.png')}});"></div>
        </div>
    </div>
</div>

<script>
    $('#sessiontoast').toast('show');
</script>

@endsection
