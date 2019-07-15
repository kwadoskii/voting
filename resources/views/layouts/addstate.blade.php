@inject('StateController', 'App\Http\Controllers\StateController')

<div class="navbar">
    <h1 class="h3 mb-3">States</h1>
    <div class="btn btn-dark ml-md-auto rounded mouse mymodal">&plus; New State</div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Participating states</h5>
                <h6 class="card-subtitle text-muted">Below is the list of participating states</h6>
            </div>
        </div>
        <table class="table table-striped table-hover small">
            <thead>
                <tr class="d-flex">
                    <th class="col-md-8">Name</th>
                    <th class="col-md-4 table-action">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($StateController->varStateList() as $state)
                <tr class="d-flex" data-id="{{ $state->id }}">
                    <td class="col-md-8">{{$state->name}}</td>
                    <td class="table-action col-md-4">
                        @include('includes.actions')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{--add new state modal--}}
@extends('includes.addmodal')

@section('new')
State
@endsection

@section('modalbody')
<div class="col-md-10 offset-md-1 mb-2">
    <small><label for="state">State Name</label></small>
    <input type="text" class="form-control" id="state" name="state" required>
    <div class="valid-tooltip">
        Looks good!
    </div>
</div>
@endsection

@section('link')"modal-save-state"@endsection


{{-- view state modal --}}
@extends('includes.viewmodal')


{{-- @if ($StateController->getid2() != null) --}}
@section('viewmodalbody')
<div class="col-md-10 offset-md-1 mb-2">
    <small><label for="state">State Name</label></small>
    <input type="text" class="form-control" id="vname" disabled
        {{-- value="{{ $StateController->varStateList()->find($StateController->$this->id)->name }}"> --}}
        value="{{ $StateController->varStateList()->find($StateController->getid2())->name }}">
    </div>
    @endsection
    {{-- @endif --}}
