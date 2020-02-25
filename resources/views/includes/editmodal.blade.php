<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal" data-dismiss="modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header mb-3">
                <h5 class="modal-title">Edit @yield('new')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="needs-validation" validate method="POST">
                    @yield('editmodalbody')
                </form>
            </div>
            <div class="modal-footer mt-4">
                <button type="button" class="btn btn-outline-success" id=@yield('editmodalid') style="float: right;">Save Changes</button>
                <button type="button" data-dismiss="modal" class="btn btn-light" style="float: left;">Close</button>
            </div>
        </div>
    </div>
</div>
