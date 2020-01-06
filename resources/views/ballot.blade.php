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
        {{-- <div class="col-md-2 list-group list-group-flush bg-primary">
            <a href="" class="list-group-item list-group-item-action bg-light">Test</a>
        </div> --}}
        {{-- <ul class="col-md-2 list-group list-group-flush navbar-nav">
            <li class="nav-item active">
                <a class="nav-link list-group-item list-group-item-action bg-light" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle list-group-item list-group-item-action bg-light" href="#" id="pagesDropdown1" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>General Elections</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown1" x-placement="bottom-start"
                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(5px, 56px, 0px);">
                    <a class="dropdown-item" href="login.html">President</a>
                    <a class="dropdown-item" href="forgot-password.html">Test</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle list-group-item list-group-item-action bg-light" href="#" id="pagesDropdown2" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>State Elections</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown2" x-placement="bottom-start"
                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(5px, 56px, 0px);">
                    <a class="dropdown-item" href="login.html">President</a>
                    <a class="dropdown-item" href="forgot-password.html">Test</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle list-group-item list-group-item-action bg-light" href="#" id="pagesDropdown3" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Constituency Election</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown3" x-placement="bottom-start"
                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(5px, 56px, 0px);">
                    <a class="dropdown-item" href="login.html">President</a>
                    <a class="dropdown-item" href="forgot-password.html">Test</a>
                </div>
            </li>
        </ul> --}}

        {{-- use this .list-group-item-action{   min-width: 130px;      } --}}

        <div class="col-md-2 navbar-nav accordion" id="accordionExample">

            <a class="nav-link dropdown-toggle list-group-item-action bg-light" href="#" id="headingOne" role="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>General Elections</span>
            </a>
            <div class="dropdown-menu" id='collapseOne' aria-labelledby="headingOne" data-parent="#accordionExample">
                <a class="dropdown-item" href="login.html">President</a>
                <a class="dropdown-item" href="forgot-password.html">Test</a>
            </div>


          <a class="nav-link dropdown-toggle list-group-item-action bg-light" href="#" id="headingTwo" role="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>General Elections</span>
            </a>
            <div class="dropdown-menu" id='collapseTwo' aria-labelledby="headingTwo" data-parent="#accordionExample">
                <a class="dropdown-item" href="login.html">President</a>
                <a class="dropdown-item" href="forgot-password.html">Test</a>
            </div>

        </div>
    </div>
</div>
</div>
@endsection
