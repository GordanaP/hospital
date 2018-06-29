<div class="modal admin-modal" tabindex="-1" role="dialog" id="editAccountModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-success border-0 text-white">
                <h5 class="modal-title uppercase">
                    <i class="icon icon-user-following"></i> Edit account
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @include('users.forms._edit')

        </div>
    </div>
</div>