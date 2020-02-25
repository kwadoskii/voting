<div class="modal fade deletemodal" tabindex="-1" role="dialog" id='deletemodal' data-dismiss="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete @yield('new')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: center; font-size: larger; margin: 0.5em 0;">
                <p>Sure to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn px-3" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-outline-danger" id=@yield('dellink') style="float: right;">Yes</button>
            </div>
        </div>
    </div>
</div>
