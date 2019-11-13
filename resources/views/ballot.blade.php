@extends('layouts.master')

@section('title')
Ballot
@endsection

@section('section')
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">E-Voting </h5>
    <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="#">{{ Auth::user()->first_name . ', ' . Auth::user()->last_name }}</a>
    </nav>
    <a class="btn btn-outline-dark" href="{{ route('userlogout') }}">Sign Out</a>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="row">
                <div class="col-md-4 bg-primary rounded">
                    <p class="lead">Election One</p>
                    <p class="bg-white">qui dolorem ipsum, quia dolor sit amet consectetur adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem/p>
                </div>

                <div class="col-md-4 bg-info rounded">
                    <p class="lead">Election Two</p>
                </div>

                <div class="col-md-4 bg-success rounded">
                    <p class="lead">Election Three</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
