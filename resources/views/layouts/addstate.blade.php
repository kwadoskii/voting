@inject('StateController', 'App\Http\Controllers\StateController')


<div class="navbar">
    <h1 class="h3 mb-3">States</h1>
    <div class="btn btn-dark ml-md-auto rounded mouse mymodal" data-toggle="modal">&plus; New State</div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Participating states</h5>
                <h6 class="card-subtitle text-muted">Below are the list of participating states</h6>
            </div>
        </div>
        <table class="table table-striped table-hover small">
            <thead>
                <tr class="d-flex">
                    <th class="col-md-8">Name</th>
                    <th class="col-md-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($StateController->varStateList() as $state)
                <tr class="d-flex">
                    <td class="col-md-8">{{$state->name}}</td>
                    <td class="table-action col-md-4">
                        <a href="#" id="edit" class="link"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="align-middle mr-3 ho">
                            <polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon>
                        </svg></a>
                        <a href="#" id="delete" class="link"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="align-middle">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{--add new admin modal--}}
<div class="modal fade" tabindex="-1" role="dialog" id="new-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header mb-3">
                <h5 class="modal-title">New State</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="needs-validation" validate method="POST">
                    <div class="form-row">
                        <div class="col-md-10 offset-md-1 mb-2">
                            <small><label for="state">State Name</label></small>
                            <input type="text" class="form-control" id="state" name="state" required>
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer mt-4">
                <button type="button" class="btn btn-dark" id="modal-save-state">Save</button>
            </div>
        </div>
    </div>
</div>
