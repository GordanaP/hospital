<div class="modal admin-modal" tabindex="-1" role="dialog" id="createAccountModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-success border-0 text-white">
                <h5 class="modal-title uppercase">
                    <i class="icon icon-user-follow mr-2"></i> New account
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @include('users.forms._create')

        </div>
    </div>
</div>