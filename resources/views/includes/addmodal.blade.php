<div class="modal fade" tabindex="-1" role="dialog" id="new-modal" data-dismiss="modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header mb-3">
                <h5 class="modal-title">New @yield('new')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="needs-validation" validate method="POST">
                    @yield('modalbody')
                </form>
            </div>
            <div class="modal-footer mt-4">
                <button type="button" class="btn btn-dark" id=@yield('link')>Save</button>
            </div>
        </div>
    </div>
</div>
