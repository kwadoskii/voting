@extends('layouts.master')

@section('title')
Admin Dashboard
@endsection

@section('head')
<link rel="stylesheet" href="{{ URL::to('src/dashboard.css') }}">
<link rel="stylesheet" href="{{ URL::to('src/main.css') }}">
@endsection

@inject('AdminController', 'App\Http\Controllers\AdminController')

@section('section')

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid my-2">
        <a class="navbar-brand" href="{{ route('admindashboard') }}">Admin Panel</a>

        <div class="btn btn-success ml-auto mr-1">{{ Auth::guard('admin')->user()->first_name}}</div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapses">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse flex-grow-0" id="navbarCollapses">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('adminlogout') }}">Sign Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link side-bar active" href="{{ route('admindashboard') }}" data-mycontent="home">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link side-bar" href="" data-mycontent="addadmin">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-file">
                                <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                <polyline points="13 2 13 9 20 9"></polyline>
                            </svg>
                            Admins
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link side-bar" href="" data-mycontent="addvoter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-shopping-cart">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg>
                            Voters
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link side-bar" href="" data-mycontent="addcandidate">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-users">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            Candidates
                        </a>
                    </li>

                    <li class="nav-item">
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>Setup</span>

                        </h6>
                        <ul class="nav flex-column">
                            {{-- <li class="nav-item">
                                <a class="nav-link side-bar" href="" data-mycontent="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-bar-chart-2">
                                        <line x1="18" y1="20" x2="18" y2="10"></line>
                                        <line x1="12" y1="20" x2="12" y2="4"></line>
                                        <line x1="6" y1="20" x2="6" y2="14"></line>
                                    </svg>
                                    Setup
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link side-bar" href="" data-mycontent="addstate">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-layers">
                                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                        <polyline points="2 17 12 22 22 17"></polyline>
                                        <polyline points="2 12 12 17 22 12"></polyline>
                                    </svg>
                                    States
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link side-bar" href="" data-mycontent="addlga">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-layers">
                                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                        <polyline points="2 17 12 22 22 17"></polyline>
                                        <polyline points="2 12 12 17 22 12"></polyline>
                                    </svg>
                                    Local Govts.
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link side-bar" href="" data-mycontent="addconstituency">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-layers">
                                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                        <polyline points="2 17 12 22 22 17"></polyline>
                                        <polyline points="2 12 12 17 22 12"></polyline>
                                    </svg>
                                    Constituencies
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link side-bar" href="" data-mycontent="addparty">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-layers">
                                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                        <polyline points="2 17 12 22 22 17"></polyline>
                                        <polyline points="2 12 12 17 22 12"></polyline>
                                    </svg>
                                    Parties
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link side-bar" href="" data-mycontent="addoffice">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-layers">
                                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                        <polyline points="2 17 12 22 22 17"></polyline>
                                        <polyline points="2 12 12 17 22 12"></polyline>
                                    </svg>
                                    Offices
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Reports</span>

                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link side-bar" href="" data-mycontent="results">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-file-text">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            Election Results
                        </a>
                    </li>

                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="container-fluid" id="mycontainer">
                @include($ab)
            </div>
        </main>
    </div>
</div>

<script src="{{ URL::to('src/main.js') }}"></script>

<script>
    var token = '{{ Session::token() }}';
    var urlAddAdmin = '{{ route('addadmin') }}';
    var urlAddState = '{{ route('addstate') }}';
    var urlAddLga = '{{ route('addlga') }}';
    var urlAddParty = '{{ route('addparty') }}';
    var urlAddVoter = '{{ route('addvoter') }}';
    var urlAddCandidate = '{{ route('addcandidate') }}';
    var urlAddConstituency = '{{ route('addconstituency') }}';
    var urlView = '{{ route('view') }}';
    var urlEdit = '{{ route('edit') }}';
    var urlAddOffice = '{{ route('addoffice') }}';
    var urlDelete = '{{ route('deletedata') }}';
    var urlGetLgaById = '{{ route('getlgabyid') }}';
    var urlGetLgaByStateId = '{{ route('getlgabystateid') }}';
    var urlGetConstiByStateId = '{{ route('getconstibystate') }}';
    var getAvailbleParty00 = '{{ route('getavailbleparty00') }}';
    var getAvailbleParty10 = '{{ route('getavailbleparty10') }}';
    var getAvailbleParty01 = '{{ route('getavailbleparty01') }}';
    var getVoteCounts = '{{ route('votecounts') }}';
</script>
@endsection
