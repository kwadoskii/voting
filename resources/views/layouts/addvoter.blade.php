@inject('UserController', 'App\Http\Controllers\UserController')
@include('includes.message')

<div class="navbar">
    <h1 class="h3 mb-3">Voters</h1>
    <div class="btn btn-dark ml-md-auto rounded mouse mymodal">&plus; Add Voter</div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Registered voters</h5>
                <h6 class="card-subtitle text-muted">Below is the list of registered voters</h6>
            </div>
        </div>
        <table class="table table-striped table-hover small" data-identifier="voter">
                <thead>
                    <tr class="d-flex">
                        <th class="col-md-1">Firstname</th>
                        <th class="col-md-1">Lastname</th>
                        <th class="col-md-1">Gender</th>
                        <th class="col-md-2">DOB</th>
                        <th class="col-md-2">LGA</th>
                        <th class="col-md-2">Constituency</th>
                        <th class="col-md-1">State</th>
                        <th class="col-md-2 table-action">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($UserController->varVoterList() as $voter)
                    <tr class="d-flex" data-id="{{ $voter->id }}">
                        <td class="col-md-1">{{$voter->first_name}}</td>
                        <td class="col-md-1">{{$voter->last_name}}</td>
                        <td class="col-md-1">{{$voter->gender}}</td>
                        <td class="col-md-2">{{$voter->DOB}}</td>
                        {{-- <td class="col-md-2">{{$voter->lga}}</td> --}}
                        <td class="col-md-2">{{$voter->constituency_id}}</td>
                        <td class="col-md-1">{{$voter->state_id}}</td>
                        {{-- <td class="col-md-2">{{$office->is_constituency  == 1 || $office->is_constituency == true ? 'Yes' : 'No'}}</td>
                        <td class="col-md-2">{{$office->is_state == 1 || $office->is_state == true ? 'Yes' : 'No'}}</td> --}}
                        <td class="table-action col-md-2">
                            @include('includes.actions')
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>

{{--add new constituency modal--}}
@extends('includes.addmodal')

@section('new')
Voter
@endsection

@section('modalbody')
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <small><label for="nin">National Identification Number</label></small>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">#</span>
                </div>
                <input type="text" class="form-control" id="nin" name="nin" required>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <small><label for="email">E-mail</label></small>
            <div class="input-group">
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4 mb-3">
            <small><label for="firstname">First Name</label></small>
            <input type="text" class="form-control" id="firstname" name="firstname" required>
        </div>

        <div class="col-md-4 mb-3">
            <small><label for="midname">Middle Name</label></small>
            <input type="text" class="form-control" id="midname" name="midname">
        </div>

        <div class="col-md-4 mb-3">
            <small><label for="lastname">Last Name</label></small>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
            </select>
        </div>

        <hr class="m-4">
    </div>


    <div class="form-row">
        <div class="col-md-4 mb-3">
            <small><label for="gender">Gender</label></small>
            <select class="form-control" name="gender" id="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
        </div>

        <div class="col-md-4 mb-3">
            <small><label for="dob">Date of Birth</label></small>
            <input type="date" class="form-control" id="dob" name="dob" required>
        </div>

        <div class="col-md-4 mb-3">
            <small><label for="phone">Phone</label></small>
            <input type="text" class="form-control" id="phone" name="phone" required>
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-12 mb-3">
            <small><label for="address">Full Address</label></small>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6 mb-3">
            <small><label for="state">State</label></small>
            <select class="form-control" name="state" id="state" required>
                <option value="">Select State</option>
                <option value="1">State One</option>
                <option value="2">State Two</option>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <small><label for="lga">Lga</label></small>
            <select class="form-control" name="lga" id="lga" required>
                <option value="">Select Lga</option>
                <option value="1">Lga One</option>
                <option value="2">Lga Two</option>
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <small><label for="password">Password</label></small>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
    </div>

@endsection

@section('link')"modal-save-constituency"@endsection
