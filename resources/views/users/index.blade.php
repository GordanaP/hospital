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

        // Create account
        var createAccountModal = $('#createAccountModal')
        var createAccountFields = ['role_id', 'title', 'first_name', 'last_name', 'email', 'password']
        var focused = $('#first_name')
        var checked = $('#auto_password')
        var hidden = $("#hidden_password").hide()

        createAccountModal.setAutofocus(focused)
        createAccountModal.emptyModal(createAccountFields, checked, hidden)

        // Create account
        $(document).on('click', '#createAccount', function() {

            createAccountModal.modal('show')

            toggleHiddenFieldWithCheckbox(hidden);

        })

        // Store account
        $(document).on('click', '#storeAccount', function() {

            var firstName = $('#first_name').val()
            var lastName = $('#last_name').val()
            var title = $('#title').val()
            var roleId = $("#role_id").val()
            var email = $('#email').val()
            var password = generatePassword(checked);

            var data = {
                first_name: firstName,
                last_name: lastName,
                title: title,
                role_id: roleId,
                email : email,
                password: password
            }

            $.ajax({
                url: accountsUrl,
                type: "POST",
                data: data,
                success: function(response) {
                    console.log(response)
                    datatable.ajax.reload();
                    successResponse(createAccountModal, response.message);
                },
                error: function(response) {
                    errorResponse(createAccountModal, jsonErrors(response));
                }
            });
        });

        // Edit account
        var editAccountModal = $('#editAccountModal')
        var editAccountFields = ['roleId', 'profileTitle', 'firstName', 'lastName', 'profileEmail', 'profilePassword']
        var focusedField = $('#firstName')
        var defaultChecked = $('#unchangedPassword')
        var togglingChecked = $('#manualPassword')
        var hiddenField = $("#hiddenPassword").hide()

        editAccountModal.setAutofocus(focusedField)
        editAccountModal.emptyModal(editAccountFields, defaultChecked, hiddenField)

        $(document).on('click', '#editAccount', function(){

            editAccountModal.modal('show')

            toggleHiddenFieldWithRadio(togglingChecked, hiddenField);

            var user = this.value
            var showAccountUrl = accountsUrl + '/' + user

            $('#updateAccount').val(user)

            $.ajax({
                url: showAccountUrl,
                type: "GET",
                success: function(response) {

                    var user = response.user

                    var roleIds = getUserRoles(user.roles)

                    $('#firstName').val(user.profile.first_name)
                    $('#lastName').val(user.profile.last_name)
                    $("#profileTitle").val(user.profile.title);
                    $("#roleId").val(roleIds).trigger("change");
                    $('#profileEmail').val(user.email)
                }
            })
        });

        // Update account

    </script>
@endsection