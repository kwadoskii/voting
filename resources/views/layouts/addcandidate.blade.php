@inject('CandidateController', 'App\Http\Controllers\CandidateController')
@include('includes.message')

<div class="navbar">
    <h1 class="h3 mb-3">Candidates</h1>
    <div class="btn btn-dark ml-md-auto rounded mouse mymodal" data-toggle="modal">&plus; New Candidate</div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Registered Candidates</h5>
                <h6 class="card-subtitle text-muted">Below is the list of Candidates.</h6>

                <select class="custom-select col-md-3 mt-2" name="search_office" id="search_office">
                    @foreach ($CandidateController->getOfficeList() as $office)
                        <option value="{{ $office->id }}" data-isState='0' data-isConsti='0'>{{ $office->name }}</option>
                    @endforeach
                </select>

                <select class="custom-select col-md-3 mt-2" name="search_state" id="search_state">
                    @foreach ($CandidateController->getStateList() as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>

                <select class="custom-select col-md-3 mt-2" name="search_consti" id="search_consti">
                    <option value="1">Abia North</option>
                    <option value="2">Abia East</option>
                    <option value="3">Abia West</option>
                </select>

                <div class="btn btn-dark form-control col-md-2 mt-2" id='candidateSearch'>Go</div>
            </div>
        </div>

        <table class="table table-striped table-hover small" data-identifier="candidate">
            <thead>
                <tr class="d-flex">
                    <th class="col-md-2">Office</th>
                    <th class="col-md-3">Name</th>
                    <th class="col-md-2">Party</th>
                    <th class="col-md-1">Age</th>
                    <th class="col-md-1">Gender</th>
                    <th class="col-md-3 table-action">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($CandidateController->getCandidateList() as $candidate)
                <tr class="d-flex" data-id="{{ $candidate->id }}">
                    <td class="col-md-2">{{ $candidate->office->name}}</td>
                    <td class="col-md-3">{{ $candidate->user->first_name . " " . $candidate->user->last_name}}</td>
                    <td class="col-md-2">{{ $candidate->party->acronym }}</td>
                    <td class="col-md-1">{{ date('Y') - date('Y', strtotime($candidate->user->DOB)) }}</td>
                    <td class="col-md-1">{{ $candidate->user->gender }}</td>
                    <td class="col-md-3 table-action">@include('includes.actions')</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{--add new Candidate modal--}}

@extends('includes.addmodal')

@section('new')
    Candidate
@endsection

@section('modalbody')
    <div class="form-row">
        <div class="col-md-6 mb-2">
            <small><label for="candidate">Office</label></small>
            <select class="selectpicker form-control picker" data-live-search="true" id="officel" name="office" required>
                @foreach ($CandidateController->getOfficeList() as $office)
                    <option value="{{ $office->id }}">{{ $office->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-2">
            <small><label for="candidate">Candidate</label></small>
            <select class="selectpicker form-control picker" data-live-search="true" id="candidate" name="candidate" required>
                <option value=""></option>
                @foreach ($CandidateController->getVoterList() as $candidate)
                    <option value="{{ $candidate->id }}">{{ $candidate->id }} | {{ $candidate->first_name . " " . $candidate->last_name}}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="form-row">
        <div class="col-md-6 mb-2">
            <small><label for="state">State</label></small>
            <select class="selectpicker form-control picker" data-live-search="true" id="state" name="state">
                @foreach ($CandidateController->getStateList() as $state)
                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-2">
            <small><label for="constituency">Constituency</label></small>
            <select class="selectpicker form-control picker" data-live-search="true" id="constituency" name="constituency">
                <option value="1">Lagos East</option>
                <option value="2">Lagos West</option>
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-12 mb-2">
            <small><label for="party">Party</label></small>
            <select class="selectpicker form-control picker" data-live-search="true" id="party" name="party" required>
                <option value="1">APC - All Progressive Congress</option>
                <option value="2">PDP - Peoples Democratic Party</option>
            </select>
        </div>
    </div>


    <script>
        $(function () {
            $('.picker').selectpicker();
        });
    </script>
@endsection

@section('link')"modal-save-lga"@endsection
