@inject('PartyController', 'App\Http\Controllers\PartyController')

<div class="navbar">
    <h1 class="h3 mb-3">Parties</h1>
    <div class="btn btn-dark ml-md-auto rounded mouse mymodal" data-toggle="modal">&plus; New Party</div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Registered Parties</h5>
                <h6 class="card-subtitle text-muted">Below is the list of parties.</h6>
            </div>
        </div>
        <table class="table table-striped table-hover small">
            <thead>
                <tr class="d-flex">
                    <th class="col-md-2">Party Acronym</th>
                    <th class="col-md-3">Party Name</th>
                    <th class="col-md-4">Description</th>
                    <th class="col-md-3 table-action">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($PartyController->varPartyList() as $party)
                <tr class="d-flex">
                    <td class="col-md-2">{{$party->acronym}}</td>
                    <td class="col-md-3">{{$party->name}}</td>
                    <td class="col-md-4">{{$party->description}}</td>
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
    Party
@endsection

@section('modalbody')
    <div class="form-row mb-2">
        <div class="col-md-6">
            <small><label for="acronym">Party Acronym</label></small>
            <input type="text" class="form-control" id="acronym" name="acronym" required>
            <div class="valid-tooltip">
                Looks good!
            </div>
        </div>
        <div class="col-md-6">
            <small><label for="name">Party Name</label></small>
            <input type="text" class="form-control" id="name" name="name" required>
            <div class="valid-tooltip">
                Looks good!
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <small><label for="desc">Description</label></small>
            <input type="text" class="form-control" id="desc" name="desc" required>
            <div class="valid-tooltip">
                Looks good!
            </div>
        </div>
    </div>
@endsection

@section('link')"modal-save-party"@endsection
