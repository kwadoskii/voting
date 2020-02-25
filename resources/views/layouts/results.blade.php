@inject('CandidateController', 'App\Http\Controllers\CandidateController')

<div class="navbar">
    <h1 class="h3 mb-3">Results</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-subtitle text-muted">Select Election</h6>

                <select class="custom-select col-md-3 mt-2" name="result_office" id="result_office">
                    @foreach ($CandidateController->getOfficeList() as $office)
                        <option value="{{ $office->id }}" data-isState='{{ $office->is_state }}' data-isConsti='{{ $office->is_constituency }}'>{{ $office->name }}</option>
                    @endforeach
                </select>

                <select class="custom-select col-md-3 mt-2" name="result_state" id="result_state">
                    @foreach ($CandidateController->getStateList() as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>

                <select class="custom-select col-md-3 mt-2" name="result_consti" id="result_consti">
                    {{-- <option value="2">Abia East</option>
                    <option value="3">Abia West</option> --}}
                </select>

                <div class="btn btn-dark form-control col-md-1 mt-2" id='resultSearch'>Go</div>
            </div>
        </div>

        <table class="table table-striped table-hover small" data-identifier="candidate">
            <thead>
                <tr class="d-flex">
                    <th class="col-md-1">S/N</th>
                    <th class="col-md-2">Office</th>
                    <th class="col-md-2">Party</th>
                    <th class="col-md-4">Name</th>
                    <th class="col-md-1">Gender</th>
                    <th class="col-md-2">Counts</th>
                </tr>
            </thead>

            <tbody id="resultbody">
                {{-- <tr class="d-flex">
                    <td class="col-md-1">1</td>
                    <td class="col-md-3">Presidency</td>
                    <td class="col-md-2">APC</td>
                    <td class="col-md-4">James Charles</td>
                    <td class="col-md-2">Male</td>
                </tr> --}}
            </tbody>
        </table>
    </div>
</div>

<script>
    $(function () {
        $('.picker').selectpicker();
    });

    //initial all invisible controls to hidden state
    $('#result_consti').hide();
    $('#result_state').hide();
    var isconsti = $('#result_office').find(':selected').data('isconsti');
    var isstate = $('#result_office').find(':selected').data('isstate');
</script>
