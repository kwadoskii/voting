@inject('StateController', 'App\Http\Controllers\StateController')
@include('includes.message')

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
                    <th class="col-md-2">Name</th>
                    <th class="col-md-2">State</th>
                    <th class="col-md-4">Composition</th>
                    <th class="col-md-1">Total Lgas</th>
                    <th class="col-md-3 table-action">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($StateController->varConstituencyList() as $constituency)
                <tr class="d-flex" data-id="{{ $constituency->id }}">
                    <td class="col-md-2">{{ $constituency->name }}</td>
                    <td class="col-md-2">{{ $constituency->state->name }}</td>
                    <td class="col-md-4">
                        @foreach ($constituency->lgas->sortBy('name') as $item)
                        @if ($loop->last)
                        {{$item->name . '.'}}
                        @else
                        {{$item->name . ','}}
                        @endif
                        @endforeach
                    </td>
                    <td class="col-md-1">{{ $constituency->lgas()->count() }}</td>
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
            <input type="text" class="form-control" id="conname" name="name" required>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-8 offset-md-2 mb-3">
            <small><label for="state">Select State:</label></small>
            <select class="custom-select form-control" id="constate" name="state" placeholder="test">
                <option value="">Choose a State</option>
                @foreach ($StateController->varStateList() as $state)
                <option value="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-8 offset-md-2 mb-3">
            <small><label for="lgas">Select Local Government Areas:</label></small>
            <select class="selectpicker form-control" multiple data-live-search="true" id="conlgas" name="lgas"></select>
        </div>
    </div>

    <script>
        $(function () {
                $('#conlgas').selectpicker();
            });
    </script>
@endsection

@section('link')"modal-save-constituency"@endsection


{{-- view constituency modal --}}
@extends('includes.viewmodal')

@section('viewmodalid')"constituency-view-modal"@endsection

@section('viewmodalbody')
    <div class="form-row">
        <div class="col-md-8 offset-md-2 mb-3">
            <small><label for="name">Constituency Name:</label></small>
            <input type="text" class="form-control" id="vconname">
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-8 offset-md-2 mb-3">
            <small><label for="name">State:</label></small>
            <input type="text" class="form-control" id="vconstate">
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-8 offset-md-2 mb-3">
            {{-- <small><label for="name">Local Governments: &nbsp;</label></small><span class="badge badge-pill badge-info" id="vconcount"></span> --}}
            <small><label for="name" class="btn btn-info">Local Governments: &nbsp; <span class="badge badge-light" id="vconcount"></span></label>
            <ul class="list-group" id="vconlgas">
                {{-- added dynamically using JS --}}
            </ul>
        </div>
    </div>
@endsection


{{-- edit constituency modal --}}
@extends('includes.editmodal')

@section('editmodalbody')
    <div class="form-row">
        <div class="col-md-8 offset-md-2 mb-3">
            <small><label for="ename">Name:</label></small>
            <input type="text" class="form-control" id="ename" required>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-8 offset-md-2 mb-3">
            <small><label for="estate">Select State:</label></small>
            <select class="custom-select form-control" id="estate">
                <option value="">Choose a State</option>
                @foreach ($StateController->varStateList() as $state)
                <option value="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-8 offset-md-2 mb-3">
            <small><label for="elgas">Select Local Government Areas:</label></small>
            <select class="selectpicker form-control" multiple data-live-search="true" id="elgas">
            </select>
        </div>
    </div>

    <script>
        $(function () {
            $('#elgas').selectpicker();
        });
    </script>
@endsection

@section('editmodalid')"modal-edit-constituency"@endsection



{{-- Delete modal --}}
@extends('includes.deletemodal')

@section('dellink')"modal-delete-lga"@endsection
