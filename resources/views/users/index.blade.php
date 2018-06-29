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

@endsection


@section('scripts')
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>

        // Initialize select.2
        $('select.role_id')
        .select2({
            placeholder: "Select role(s)",
            width: "100%",
        });

        // Datatable
        @include('users.tables._datatable')

        // ACCOUNT
        var accountsUrl = "{{ route('admin.accounts.index') }}"
        var accountFields = ['role_id', 'title', 'first_name', 'last_name', 'email', 'password']

        // Create account
        var createAccountModal = $('#createAccountModal')
        var focused = $('#first_name')
        var checked = $('#auto_password')
        var hidden = $("#hidden_password").hide()

        createAccountModal.setAutofocus(focused)
        createAccountModal.emptyModal(accountFields, checked, hidden)

        // Create account
        $(document).on('click', '#createAccount', function() {

            createAccountModal.modal('show')

            toggleHiddenFieldWithCheckbox(checked, hidden);

        })

        // Store account
        $(document).on('click', '#storeAccount', function() {

            var firstName = $('#first_name').val()
            var lastName = $('#last_name').val()
            var email = $('#email').val()
            var password = generatePassword(checked);

            var data = {
                first_name: firstName,
                last_name: lastName,
                email : email,
                password: password
            }

            $.ajax({
                url: accountsUrl,
                type: "POST",
                data: data,
                success: function(response) {

                    datatable.ajax.reload();
                    successResponse(createAccountModal, response.message);
                },
                error: function(response) {
                    errorResponse(createAccountModal, jsonErrors(response));
                }
            });
        });

    </script>
@endsection