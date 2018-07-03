@extends('layouts.admin')

@section('title', ' | Admin | Users')

@section('links')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" />
@endsection

@section('content')

    @admcontent
        @slot('card')
            @include('users.tables._htmltable')
        @endslot
    @endadmcontent

    @include('users.modals._create')
    @include('users.modals._edit')

@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>

        var rolesUrl = "{{ route('admin.roles.index') }}";
        var accountsUrl = "{{ route('admin.accounts.index') }}";
        var accountFields = ['first_name',  'last_name', 'title', 'role_id', 'email', 'password']; // same names for both forms required for emptyng errors!
        var selectRoles = $('select.role_id');
        var roleToRemove = 3; // admin role has no titles!

        // Select2 multiple
        @include('users.js._select2')

        // Form tooltps
        $('[data-toggle="tooltip"]').tooltip();

        // Datatable
        @include('users.tables._datatable');

        // Create account
        @include('users.js._create');

        // Store account
        @include('users.js._store');

        // Edit account
        @include('users.js._edit');

        // Update account
        @include('users.js._update');

        // Delete with swal popoup
        @include('users.js._delete');

    </script>
@endsection