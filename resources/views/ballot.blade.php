@extends('layouts.master')

@section('head')
<link rel="stylesheet" href="{{ URL::to('src/ballot.css') }}">
@endsection

@section('title')
Ballot Box
@endsection

@section('confirmVotemodalid')
    confirmVoteBtn
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
    <div class="row wrapper">

        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-2">
            <div class="sidebar-header">
                <h6>Select Ballot</h6>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="#genSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">General
                        Elections</a>
                    <ul class="collapse list-unstyled" id="genSubmenu">
                        <li>
                            @foreach ($offices as $office)
                            @if($office->is_state == '0' && $office->is_constituency == '0' )
                            <a href="#" class="genElec" data-office_id="{{ $office->id }}">{{ $office->name}}</a>
                            @endif
                            @endforeach
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#stateSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">State
                        Elections</a>
                    <ul class="collapse list-unstyled" id="stateSubmenu">
                        <li>
                            @foreach ($offices as $office)
                            @if($office->is_state == '1' && $office->is_constituency == '0' )
                        <a href="#" class="stateElec" data-office_id="{{ $office->id }}" data-state_id="{{ Auth::user()->state_id }}">{{ $office->name}}</a>
                            @endif
                            @endforeach
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#constiSubmenu" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">Constituency Elections</a>
                    <ul class="collapse list-unstyled" id="constiSubmenu">
                        <li>
                            @foreach ($offices as $office)
                            @if($office->is_state == '0' && $office->is_constituency == '1' )
                            <a href="#" class="constiElec" data-office_id="{{ $office->id }}" data-state_id="{{ Auth::user()->state_id }}" data-lga_id="{{ Auth::user()->lga_id }}">{{ $office->name}}</a>
                            @endif
                            @endforeach
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div id="content" class="col-md-10">
            <div class="col-md-12 mt-3 mb-3">
                <h5 id="ballotheader" class="text-center">Welcome</h5>
            </div>

            <div class="row @if (Auth::user()->isvoted == '0') ballotbox @endif">
                <div class="jumbotron col-md-8 offset-md-2 mt-2 p-20">
                    @if (Auth::user()->isvoted == '1')
                        <p class='lead text-center'>You have already voted in this election.</p>
                    @else
                        <h3 class='lead text-center'>Please select an election category from the left and cast your vote.</h3>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
</div>

@include('includes.confirmvotemodal')
@include('includes.message')
{{-- https://bootstrapious.com/p/bootstrap-sidebar for the sidebar--}}
<script>
    var token = '{{ Session::token() }}';
    var getOfficebyId = '{{ route('getOfficebyId') }}';
    var getStateOfficebyId = '{{ route('getStateOfficebyId') }}';
    var getConstiOfficebyId = '{{ route('getConstiOfficebyId') }}';
    var vote = '{{ route('vote') }}';
</script>
<script src="{{ URL::to('src/bootstrap.min.js') }}"></script>
<script src="{{ URL::to('src/ballot.js') }}">
</script>
{{-- <script src="{{ URL::to('src/ajax.js') }}"></script> --}}

<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
@endsection
