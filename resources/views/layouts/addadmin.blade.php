@inject('AdminController', 'App\Http\Controllers\AdminController' )

<div class="navbar">
    <h1 class="h3 mb-3">Administrators</h1>
    <div class="btn btn-dark ml-md-auto rounded mouse mymodal" data-toggle="modal">&plus; New Admin</div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Registered Admins</h5>
                <h6 class="card-subtitle text-muted">Below is the list of administrators</h6>
            </div>
        </div>
        <table class="table table-striped table-hover small">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>E-mail</th>
                    <th>Date Created</th>
                    <th class="table-action">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($AdminController->varAdminList() as $admin)
                <tr>
                    <td>{{$admin->first_name}}</td>
                    <td>{{$admin->last_name}}</td>
                    <td>{{$admin->email}}</td>
                    <td>{{($admin->created_at)->format('d-M-Y')}}</td>
                    <td class="table-action">
                        @include('includes.actions')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


{{--add new admin modal--}}
@extends('includes.addmodal')

@section('new')
    Admin
@endsection

@section('modalbody')
    <div class="form-row">
        <div class="col-md-4 mb-2">
            <small><label for="firstname">First Name</label></small>
            <input type="text" class="form-control" id="firstname" name="firstname" required>
            <div class="valid-tooltip">
                Looks good!
            </div>
        </div>

        <div class="col-md-4 mb-2">
            <small><label for="middlename">Middle Name</label></small>
            <input type="text" class="form-control" id="middlename" name="middlename">
            <div class="valid-tooltip">
                Looks good!
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <small><label for="lastname">Last Name</label></small>
            <div class="input-group">
                <input type="text" class="form-control" id="lastname" name="lastname" required>
                <div class="invalid-tooltip">
                    Looks good!
                </div>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-3 mb-2">
            <div class="form-group">
                <small><label for="gender">Gender</label></small>
                <select class="custom-select" name="gender" id="gender" required>
                    <option value="">Select gender</option>
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                </select>
            </div>
        </div>

        <div class="col-md-3 mb-2">
            <small><label for="dob">Date of Birth</label></small>
            <input type="date" class="form-control" id="dob" name="dob" required>
            <div class="invalid-tooltip">
                Please provide a valid state.
            </div>
        </div>

        <div class="col-md-6 mb-2">
            <small><label for="phone">Phone Number</label></small>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6 mb-2">
            <small><label for="email">E-mail</label></small>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <div class="col-md-3 mb-2">
            <small><label for="email">Password</label></small>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <div class="col-md-3 mb-2">
            <small><label for="email">Confrim pasword</label></small>
            <input type="password" class="form-control" name="cpassword" id="cpassword" required>
        </div>
    </div>
@endsection

@section('link')"modal-save-admin"@endsection
