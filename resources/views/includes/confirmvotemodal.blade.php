<div class="modal fade" tabindex="-1" role="dialog" id="confirmVote-modal" data-backdrop="static" data-dismiss="modal">
    <div class="modal-dialog modal modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header mb-2">
                <h5 class="modal-title">Confirm Vote</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center blk">Want to vote for <span id="mpartyacr"></span>?</p>
            </div>
            <div class="modal-footer mt-2">
                <button type="button" class="btn btn-success" id=@yield('confirmVotemodalid')>Yes</button>
                <button type="button" data-dismiss="modal" class="btn btn-danger" style="float: right;">No</button>
            </div>
        </div>
    </div>
</div>
