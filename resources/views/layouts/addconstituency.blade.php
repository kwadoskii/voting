@inject('StateController', 'App\Http\Controllers\StateController')

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
                    <th class="col-md-3">Name</th>
                    <th class="col-md-2">State</th>
                    <th class="col-md-4">Lgas</th>
                    <th class="col-md-3 table-action">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($StateController->varConstituencyList() as $constituency)
                    <tr class="d-flex" data-id="{{ $constituency->id }}">
                        <td class="col-md-3">{{$constituency->name}}</td>
                        <td class="col-md-2">{{ $constituency->state}}</td>
                        {{-- <td class="col-md-4">{{$constituency->lgas->name}}</td> --}}
                        <td class="table-action col-md-3">
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
    Constituency
@endsection

@section('modalbody')
    <div class="form-row">
        <div class="col-md-8 offset-md-2 mb-3">
            <small><label for="name">Name:</label></small>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-8 offset-md-2 mb-3">
            <small><label for="state">Select State:</label></small>
            <select class="custom-select form-control" id="state" name="state" placeholder="test">
                @foreach ($StateController->varStateList() as $state)
                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-8 offset-md-2 mb-3">
            <small><label for="lgas">Select Local Government Areas:</label></small>
            <select class="selectpicker form-control" multiple data-live-search="true" id="lgas" name="lgas">
                <option value="1">Agege</option>
                <option value="2">Badagry</option>
                <option value="3">Epe</option>
                <option value="4">Ikeja</option>
                <option value="5">Mushin</option>
            </select>
        </div>
    </div>

    <script>
        $(function () {
            $('select.selectpicker').selectpicker();
        });
    </script>
@endsection
