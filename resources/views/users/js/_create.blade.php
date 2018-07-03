var createAccountModal = $('#createAccountModal');
var focused = $('#first_name');
var checked = $('#auto_password');
var hidden = $("#hidden_password").hide();

createAccountModal.setAutofocus(focused);
createAccountModal.emptyModal(accountFields, checked, hidden);

// Remove role-dependant titles on modal close
createAccountModal.on("hidden.bs.modal", function() {

    $('select#title').children('option:not(:first)').remove();
})

// Create account
$(document).on('click', '#createAccount', function() {

    createAccountModal.modal('show');

    toggleHiddenFieldWithCheckbox(hidden);
});
