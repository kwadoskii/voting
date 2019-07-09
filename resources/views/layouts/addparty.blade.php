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
                    <th class="col-md-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($PartyController->varPartyList() as $party)
                <tr class="d-flex">
                    <td class="col-md-2">{{$party->acronym}}</td>
                    <td class="col-md-3">{{$party->name}}</td>
                    <td class="col-md-4">{{$party->description}}</td>
                    <td class="table-action col-md-3">
                        <a href="#" id="edit" class="link"><svg xmlns="http://www.w3.org/2000/svg" width="18"
                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="align-middle mr-3">
                                <polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon>
                            </svg></a>
                        <a href="#" id="delete" class="link"><svg xmlns="http://www.w3.org/2000/svg" width="18"
                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="align-middle mr-3">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                </path>
                            </svg></a>
                        <a href="#" id="view" class="link"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                            fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="align-middle" style="
                            width: 18px;
                            height: 18px;">
                            <path
                                d="M416 48c0-8.84-7.16-16-16-16h-64c-8.84 0-16 7.16-16 16v48h96V48zM63.91 159.99C61.4 253.84 3.46 274.22 0 404v44c0 17.67 14.33 32 32 32h96c17.67 0 32-14.33 32-32V288h32V128H95.84c-17.63 0-31.45 14.37-31.93 31.99zm384.18 0c-.48-17.62-14.3-31.99-31.93-31.99H320v160h32v160c0 17.67 14.33 32 32 32h96c17.67 0 32-14.33 32-32v-44c-3.46-129.78-61.4-150.16-63.91-244.01zM176 32h-64c-8.84 0-16 7.16-16 16v48h96V48c0-8.84-7.16-16-16-16zm48 256h64V128h-64v160z">
                            </path>
                        </svg></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{--add new party modal--}}
<div class="modal fade" tabindex="-1" role="dialog" id="new-modal" data-dismiss="modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header mb-3">
                <h5 class="modal-title">New Party</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="needs-validation" validate method="POST">
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
                </form>
            </div>
            <div class="modal-footer mt-4">
                <button type="button" class="btn btn-dark" id="modal-save-party">Save</button>
            </div>
        </div>
    </div>
</div>
