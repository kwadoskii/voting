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

                <select class="custom-select col-md-3 mt-2" name="office" id="office">
                    <option value="1">President</option>
                    <option value="2">Governor</option>
                    <option value="3">Senator</option>
                </select>

                <select class="custom-select col-md-3 mt-2" name="office-state" id="office-state">
                    <option value="11">Abia</option>
                    <option value="12">Adamawa</option>
                    <option value="13">Akwa Ibom</option>
                </select>

                <select class="custom-select col-md-3 mt-2" name="office-consti" id="office-consti">
                    <option value="1">Abia North</option>
                    <option value="2">Abia East</option>
                    <option value="3">Abia West</option>
                </select>

                <div class="btn btn-dark form-control col-md-2 mt-2">Go</div>
            </div>
        </div>

        <table class="table table-striped table-hover small" data-identifier="candidate">
            <thead>
                <tr class="d-flex">
                    <th class="col-md-2">Office</th>
                    <th class="col-md-3">Candidate Name</th>
                    <th class="col-md-2">Party</th>
                    <th class="col-md-1">Age</th>
                    <th class="col-md-1">Gender</th>
                    <th class="col-md-3 table-action">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($CandidateController->getCandidateList() as $candidate)
                    <tr class="d-flex" data-id="{{ $candidate->id }}">
                    <th class="col-md-2">{{ $candidate->office->name}}</th>
                        <th class="col-md-3">{{ $candidate->user->first_name . " " . $candidate->user->last_name}}</th>
                        <th class="col-md-2">{{ $candidate->party->acronym }}</th>
                        <th class="col-md-1">Age</th>
                        <th class="col-md-1">Gender</th>
                        <th class="col-md-3 table-action">Actions</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
