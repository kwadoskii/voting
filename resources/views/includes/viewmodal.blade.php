<div class="modal fade view-modal" tabindex="-1" role="dialog" id=@yield('viewmodalid') data-dismiss="modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header mb-3">
                <h5 class="modal-title">View @yield('new')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    @yield('viewmodalbody')
                </form>
            </div>
            <div class="modal-footer mt-4">
                <button type="button" class="btn btn-light" data-dismiss="modal" style="float: right;">Close</button>
            </div>
        </div>
    </div>
</div>
