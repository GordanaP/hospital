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
