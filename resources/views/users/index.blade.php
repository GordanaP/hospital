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

        var rolesUrl = "{{ route('admin.roles.index') }}"
        var select = $('.role_id');

        // Select2 multiple
        $('select.role_id').select2({
            placeholder:'Select roles',
            maximumSelectionLength: 2,
            width: "100%",
            allowClear: true
        });


        // Select2 multiple
        $('.role_id').on('select2:select', function (e) {

            // Unselect an option
            var select = $(this)
            var selected = e.target.value;
            var triggerValue = 1;
            var valueToUnselect = 2;
            var lastSelected = e.params.data.id;
            console.log(lastSelected)
            unselectOption(select, selected, triggerValue, valueToUnselect);

            // Create a dependant dropdown list
            var roleId = $(this).val();
            var itemToRemove = 3;

            roleId = $.grep(roleId, function( val, index ) {
              return val < itemToRemove;
            });

            var showRoleUrl = rolesUrl + '/' + roleId

            $.ajax({
                url: showRoleUrl,
                type: 'GET',
                success: function(response)
                {
                    var titles = response.role ? response.role.titles : ''
                    var html;

                    $.each(titles, function(index, title) {
                        html += '<option value="'+ title.id +'">'+ title.name+'</option>'
                    });

                    lastSelected == 3 ? '' : $('select#title, select#profileTitle').empty().append('<option>Select a title</option>').append(html)
                }
            });
        });

        // Remove titles on unselect particular roles
        $('.role_id').on('select2:unselect', function (e) {

            var unselected = e.params.data.id;

            // Do not remove role-depenent titles if unselect admin
            unselected == 3 ? '' : $('select#title, select#profileTitle').empty().append('<option>Select a title</option>')
        });

        // Form tooltps
        $('[data-toggle="tooltip"]').tooltip();

        // Datatable
        @include('users.tables._datatable');

        // ACCOUNT
        var accountsUrl = "{{ route('admin.accounts.index') }}";
        /*the names for create & edit form must be the same for emptying the errosrs on modal close*/
        var accountFields = ['first_name',  'last_name', 'title', 'role_id', 'email', 'password'];

        // Create account
        var createAccountModal = $('#createAccountModal');
        var focused = $('#first_name');
        var checked = $('#auto_password');
        var hidden = $("#hidden_password").hide();

        createAccountModal.setAutofocus(focused);
        createAccountModal.emptyModal(accountFields, checked, hidden);

        // Create account
        $(document).on('click', '#createAccount', function() {

            createAccountModal.modal('show');

            toggleHiddenFieldWithCheckbox(hidden);
        });

        // Store account
        $(document).on('click', '#storeAccount', function() {

            var firstName = $('#first_name').val();
            var lastName = $('#last_name').val();
            var title = $('#title').val();
            var roleId = $("#role_id").val();
            var email = $('#email').val();
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

                    datatable.ajax.reload();
                    successResponse(createAccountModal, response.message);
                },
                error: function(response) {

                    errorResponse(createAccountModal, jsonErrors(response));
                }
            });
        });

        // Edit account
        var editAccountModal = $('#editAccountModal');
        var focusedField = $('#firstName');
        var defaultChecked = $('#unchangedPassword');
        var togglingChecked = $('#manualPassword');
        var hiddenField = $("#hiddenPassword").hide();

        editAccountModal.setAutofocus(focusedField);
        editAccountModal.emptyModal(accountFields, defaultChecked, hiddenField);

        $(document).on('click', '#editAccount', function(){

            editAccountModal.modal('show');

            toggleHiddenFieldWithRadio(togglingChecked, hiddenField);

            var user = this.value;
            var showAccountUrl = accountsUrl + '/' + user;

            $('#updateAccount').val(user);

            $.ajax({
                url: showAccountUrl,
                type: "GET",
                success: function(response) {

                    console.log(response)

                    var user = response.user;
                    var profile = response.user.profile;
                    var roles = response.user.roles;
                    var roleIds = getUserRoles(roles);
                    var itemToRemove = 3;

                    roleId = $.grep(roleIds, function( val, index ) {
                      return val < itemToRemove;
                    });

                    var html = '';

                    $.each(roles, function(index, role) {
                         if (role.id == roleId) {
                            $.each(role.titles, function(index, title) {
                                 html += '<option value="'+ title.id +'">'+ title.name+'</option>'
                            });
                         }
                    });

                    $('select#profileTitle').empty().append('<option>Select a title</option>').append(html)

                    $('#firstName').val(profile.first_name);
                    $('#lastName').val(profile.last_name);
                    $("#profileTitle").val(profile.title);
                    $("#roleId").val(roleIds).trigger("change");
                    $('#profileEmail').val(user.email);
                }
            });

        });

        // Update account
        $(document).on('click', '#updateAccount', function() {

            var user = this.value;
            var updateAccountUrl = accountsUrl + '/' + user;

            var firstName = $('#firstName').val();
            var lastName = $('#lastName').val();
            var title = $('#profileTitle').val();
            var roleId = $("#roleId").val();
            var email = $('#profileEmail').val();
            var checkedRadio = $("input[name='createPassword']:checked"). val();
            var checkedManual = $('#manualPassword').val();
            var checkedAuto = $('#autoPassword').val();
            var profilePassword = $('#profilePassword').val();
            var password = changePassword(checkedRadio, checkedManual, checkedAuto, profilePassword);

            var data = {
                first_name : firstName,
                last_name : lastName,
                title : title,
                role_id: roleId,
                email : email,
                create_password: checkedRadio,
                password: password,
                password_confirmation: password,
            }

            $.ajax({
                url : updateAccountUrl,
                type : "PUT",
                data: data,
                success : function(response) {

                    // $('#myAccount').load(location.href + ' #myAccount');
                    // $('#displayUserName').load(location.href + ' #displayUserName');
                    console.log(response);
                    datatable ? datatable.ajax.reload() : '';

                    successResponse(editAccountModal, response.message);
                },
                error: function(response) {
                    errorResponse(editAccountModal, jsonErrors(response));
                }
            });
        });

        $(document).on('click', '#deleteAccount', function() {

            var user = this.value;
            var deleteAccountUrl = accountsUrl + '/' + user

            swal({
                title: 'Are you sure you want to delete the account?',
                text: 'Once the account has been deleted you will not be able to recover it!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if(result.value == true)
                {
                    $.ajax({
                        url: deleteAccountUrl,
                        type: 'DELETE',
                        success: function(response)
                        {
                            datatable ? datatable.ajax.reload() : ''
                            successResponse(response.message)
                        }
                    })
                }
            });
        });

    </script>

@endsection