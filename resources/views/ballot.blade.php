@extends('layouts.master')

@section('title')
Ballot
@endsection

@section('head')
<link rel="stylesheet" href="{{ URL::to('src/ballot.css') }}">
@endsection

@section('section')
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <button type="button" id="sidebarCollapse" class="btn btn-info mr-1">
        <i class="fas fa-align-left"></i>
        <span></span>
    </button>
    <h5 class="my-0 font-weight-normal mr-md-auto">E-Voting </h5>

    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="#">{{ Auth::user()->first_name . ', ' . Auth::user()->last_name }}</a>
    </nav>
    <a class="btn btn-outline-dark" href="{{ route('userlogout') }}">Sign Out</a>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="wrapper">

            <!-- Sidebar -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h6>Select Ballot</h6>
                </div>

                <ul class="list-unstyled components">
                    <li>
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">General Elections</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="#">President</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">State Elections</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="#">Governor</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Constituency Elections</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu2">
                            <li>
                                <a href="#">Senatorial</a>
                            </li>
                            <li>
                                <a href="#">House of Representatives</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <div id="content">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <div class="ballotbox">
                            
                        </div>
                    </div>
                </nav>
            </div>

        </div>
    </div>
</div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

<script>
    $(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
    });

    });
</script>
@endsection
