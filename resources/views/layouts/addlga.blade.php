@inject('StateController', 'App\Http\Controllers\StateController')
@include('includes.message')

<div class="navbar">
    <h1 class="h3 mb-3">Local Government Areas</h1>
    <div class="btn btn-dark ml-md-auto rounded mouse mymodal" data-toggle="modal">&plus; New LGA</div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Participating states</h5>
                <h6 class="card-subtitle text-muted">Below is the list of participating local government areas.</h6>
            </div>
        </div>
        <table class="table table-striped table-hover small" data-identifier="lga">
            <thead>
                <tr class="d-flex">
                    <th class="col-md-4">Name</th>
                    <th class="col-md-3">Constituency</th>
                    <th class="col-md-2">State</th>
                    <th class="col-md-3 table-action">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($StateController->varLgaList()->sortBy('name') as $lga)
                <tr class="d-flex" data-id="{{ $lga->id }}">
                    <td class="col-md-4">{{$lga->name}}</td>

                    @if ($lga->constituency == null)
                        <td class="col-md-3"><span class="badge-info badge-pill p-2 badge">No Constituency</span></td>
                    @else
                        <td class="col-md-3">{{ $lga->constituency->name }}</td>
                    @endif

                    <td class="col-md-2">{{$lga->state->name}}</td>
                    <td class="table-action col-md-3">
                        @include('includes.actions')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

{{--add new lga modal--}}

@extends('includes.addmodal')

@section('new')
    LGA
@endsection

@section('modalbody')
    <div class="form-row">
        <div class="col-md-6 mb-2">
            <small><label for="lga">LGA Name</label></small>
            <input type="text" class="form-control" id="lga" name="lga" required>
            <div class="valid-tooltip">
                Looks good!
            </div>
        </div>

        <div class="col-md-6 mb-2">
            <small><label for="lga">LGA State</label></small>
            <select class="custom-select" name="state" id="state" required>
                <option selected>Select State</option>
                @foreach ($StateController->varStateList() as $state)
                    <option value="{{$state->id}}">{{$state->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
@endsection

@section('link')"modal-save-lga"@endsection


{{-- view state modal --}}
@extends('includes.viewmodal')

@section('viewmodalid')"lga-view-modal"@endsection

@section('viewmodalbody')
<div class="form-row">
    <div class="col-md-6 mb-2">
        <small><label for="vlga">LGA Name</label></small>
        <input type="text" class="form-control" id="vlga" disabled>
    </div>

        <div class="col-md-6 mb-2">
            <small><label for="vstate">LGA State</label></small>
            <input type="text" class="form-control" id="vstate" disabled>
        </div>
    </div>
@endsection


{{-- edit lga modal --}}
@extends('includes.editmodal')

@section('editmodalbody')
    <div class="form-row">
        <div class="col-md-6 mb-2">
            <small><label for="elga">LGA Name</label></small>
            <input type="text" class="form-control" id="elga" required>
            <div class="valid-tooltip">
                Looks good!
            </div>
        </div>

        <div class="col-md-6 mb-2">
            <small><label for="elga">LGA State</label></small>
            <select class="custom-select" id="estate" required>
                <option selected>Select State</option>
                @foreach ($StateController->varStateList() as $state)
                <option value="{{$state->id}}">{{$state->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
@endsection

@section('editmodalid')"modal-edit-lga"@endsection


{{-- Delete modal --}}
@extends('includes.deletemodal')

@section('dellink')"modal-delete-lga"@endsection
