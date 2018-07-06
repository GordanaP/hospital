// Edit account
var editAccountModal = $('#editAccountModal');
var focusedField = $('#firstName');
var defaultChecked = $('#unchangedPassword');
var togglingChecked = $('#manualPassword');
var hiddenField = $("#hiddenPassword").hide();
var roleToRemove = 3;

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

            var user = response.user;
            var profile = response.user.profile;
            var roles = response.user.roles;
            var roleIds = getUserRoles(roles);
            var roleId = getFirstRoleId(roleIds, roleToRemove)
            var options;

            $.each(roles, function(i, role) {
                 if (role.id == roleId) {
                     options =  getOptions(role.titles)
                 }
            });

            selectProfileTitle.empty().append(placeholder).append(options);

            $('#firstName').val(profile.first_name);
            $('#lastName').val(profile.last_name);
            $("#profileTitle").val(profile.title);
            $("#roleId").val(roleIds).trigger("change");
            $('#profileEmail').val(user.email);
        }
    });
});