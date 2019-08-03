<div class="navbar">
    <h1 class="h3 mb-3">Constituencies</h1>
    <div class="btn btn-dark ml-md-auto rounded mouse mymodal" data-toggle="modal">&plus; New Constituency</div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Registered Constituencies</h5>
                <h6 class="card-subtitle text-muted">Below is the list of Constituencies</h6>
            </div>
        </div>
        <table class="table table-striped table-hover small" data-identifier="constituency">
            <thead>
                <tr class="d-flex">
                    <th class="col-md-4">Name</th>
                    <th class="col-md-5">State</th>
                    <th class="col-md-3 table-action">Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($ConstituencyController->varConstituencyList() as $constituency)
                    <tr class="d-flex" data-id="{{ $constituency->id }}">
                    <td class="col-md-4">{{$constituency->name}}</td>
                    <td class="col-md-5">{{($constituency->state}}</td>
                    <td class="table-action col-md-3">
                        @include('includes.actions')
                    </td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
</div>

{{--add new constituency modal--}}
@extends('includes.addmodal')

@section('new')
    Constituency
@endsection

@section('modalbody')
    <div class="form-group">
        <label for="multi-select">Select state:</label>
        <select class="selectpicker" multiple data-live-search="true">
            <option value="">State</option>
            <option value="1">PHP</option>
            <option value="2">HTML</option>
            <option value="2">SQL</option>
            <option value="2">JS</option>
            <option value="2">C#</option>
        </select>
    </div>
@endsection
