// Initialize select2
selectRoles.select2({
    placeholder:'Select roles',
    maximumSelectionLength: 2,
    width: "100%",
});

// Handle event:select - create a role-dependant titles dropdown list
selectRoles.on('select2:select', function (e) {

    // Unselect an option and replace with new selected
    var selectedRole = e.target.value;
    var lastSelected = e.params.data.id;
    var doctorRole = 1;
    var nurseRole = 2;

    replaceSelectedOption(selectedRole, doctorRole, lastSelected, nurseRole)

    // Create a role-dependant titles dropdown list
    var allSelected = $(this).val();
    var roleId = getRoleId(allSelected, roleToRemove);

    var showRoleUrl = rolesUrl + '/' + roleId;

    $.ajax({
        url: showRoleUrl,
        type: 'GET',
        success: function(response)
        {
            var titles = response.role ? response.role.titles : '';
            var options = getTitlesOptions(titles);

            appendTitleOptions(lastSelected, roleToRemove, options);
        }
    });
});

// Handle event:unselect - remove role depenedant titles
selectRoles.on('select2:unselect', function (e) {

    var lastSelected = e.params.data.id;

    // Do not remove role-depenent titles if unselect admin role
    appendTitleOptions(lastSelected, roleToRemove);
});
