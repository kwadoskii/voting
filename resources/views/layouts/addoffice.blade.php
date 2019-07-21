@inject('OfficeController', 'App\Http\Controllers\OfficeController')

<div class="navbar">
    <h1 class="h3 mb-3">Offices</h1>
    <div class="btn btn-dark ml-md-auto rounded mouse mymodal" data-toggle="modal">&plus; New Office</div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Registered Parties</h5>
                <h6 class="card-subtitle text-muted">Below is the list of offices.</h6>
            </div>
        </div>
        <table class="table table-striped table-hover small" data-identifier="office">
            <thead>
                <tr class="d-flex">
                    <th class="col-md-5">Office Name</th>
                    <th class="col-md-2">Is Constituency</th>
                    <th class="col-md-2">Is State</th>
                    <th class="col-md-3 table-action">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($OfficeController->varOfficeList() as $office)
                <tr class="d-flex" data-id="{{ $office->id }}">
                    <td class="col-md-5">{{$office->name}}</td>
                    <td class="col-md-2">
                        {{$office->is_constituency  == 1 || $office->is_constituency == true ? 'Yes' : 'No'}}</td>
                    <td class="col-md-2">{{$office->is_state == 1 || $office->is_state == true ? 'Yes' : 'No'}}</td>
                    <td class="table-action col-md-3">
                        @include('includes.actions')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{--add new party modal--}}

@extends('includes.addmodal')

@section('new')
Office
@endsection

@section('modalbody')
<div class="form-row mb-2">
    <div class="col-md-8">
        <small><label for="name">Office Name</label></small>
        <input type="text" class="form-control" id="name" name="name" required>
        <div class="valid-tooltip">
            Looks good!
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-md-6">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="consti" value="0">
            <label class="custom-control-label" for="consti">Is Constituency?</label>
        </div>
    </div>

    <div class="col-md-6 mt-2">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="state" value="0">
            <label class="custom-control-label" for="state">Is State?</label>
        </div>
    </div>
</div>
@endsection

@section('link')"modal-save-office"@endsection


{{-- view state modal --}}
@extends('includes.viewmodal')

@section('viewmodalid')"office-view-modal"@endsection

@section('viewmodalbody')
<div class="form-row mb-2">
    <div class="col-md-8">
        <small><label for="name">Office Name</label></small>
        <input type="text" class="form-control" id="vname" disabled>
    </div>
</div>

<div class="form-row">
    <div class="col-md-6">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="vconsti" disabled>
            <label class="custom-control-label" for="vconsti">Is Constituency?</label>
        </div>
    </div>

    <div class="col-md-6 mt-2">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="vstate" disabled>
            <label class="custom-control-label" for="vstate">Is State?</label>
        </div>
    </div>
</div>
@endsection

{{-- Delete modal --}}
@extends('includes.deletemodal')