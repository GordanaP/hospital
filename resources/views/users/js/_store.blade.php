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