<div class="card-header p-3 flex justify-between align-center" id="datatableCardHeader">

    <h1 class="font-medium text-4xl ml-3 mb-0">Users
        <small class="text-white bg-red-dark rounded-full pt-1 pb-1 pl-2 pr-2"">
            {{ $users->count() }}
        </small>
    </h1>

    <button type="button" class="btn btn-lg btn-success pull-right mr-3" id="createAccount">
        <i class="icon icon-plus mr-1"></i>
        Add User
    </button>

</div>

<div class="card-body pt-4">
    <div class="table-responsive admin-table-wrapper">
        <table class="table hover order-column table-bordered table-striped admin-table" id="accountsTable" cellspacing="0" width="100%">
            <thead>
                <th class="text-center">#</th>
                <th class="text-uppercase text-black font-medium"><i class="fa fa-user mr-2"></i> Name</th>
                <th class="text-uppercase text-black font-medium"><i class="fa fa-envelope mr-2"></i> Email</th>
                <th class="text-uppercase text-black font-medium"><i class="fa fa-briefcase mr-2"></i> Role</th>
                <th class="text-uppercase text-black font-medium"><i class="fa fa-circle mr-2"></i> Status</th>
                <th class="text-uppercase text-black font-medium"><i class="fa fa-calendar mr-2"></i> Created</th>
                <th class="text-uppercase text-black font-medium"><i class="fa fa-calendar mr-2"></i> Updated</th>
                <th class="text-center"><i class="fa fa-cog"></i></th>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>