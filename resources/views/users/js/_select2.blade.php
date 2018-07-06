var selectRoles = $('select.role_id');
var selectTitle = $('select#title');
var selectProfileTitle = $('select#profileTitle');
var roles = { doctor : 1, nurse : 2, admin : 3 }
var placeholder = '<option value="0">Select a title</option>'

// Initialize select2
selectRoles.select2({
    placeholder:'Select roles',
    maximumSelectionLength: 2,
    width: "100%",
    allowClear: true
});

// Handle event:select
selectRoles.on('select2:select', function (e) {

    // Unselect an option and replace with last selected
    var selected = e.target.value;
    var lastSelected = e.params.data.id;
    var allSelected = $(this).val();

    replaceSelectedOption(selected, lastSelected, roles)

    // Create a role-dependant titles list
    var roleId = getRoleId(selected, lastSelected, allSelected, roles);
    var showRoleUrl = rolesUrl + '/' + roleId;

    $.ajax({
        url: showRoleUrl,
        type: 'GET',
        success: function(response)
        {
            var titles = response.role ? response.role.titles : '';
            var options = getOptions(titles)

            appendOptions(selectTitle, selectProfileTitle, placeholder, options)
        }
    });
});

// Handle event:unselect
selectRoles.on('select2:unselect', function (e) {

    var allSelected = $(this).val();
    var lastUnSelected = e.params.data.id;
    var countSelected = $(this).find('option:selected').length;

    var adminRoleId = roles['admin'];
    var showRoleUrl = rolesUrl + '/' + adminRoleId;

    $.ajax({
        url: showRoleUrl,
        type: 'GET',
        success: function(response)
        {
            var adminTitles = response.role ? response.role.titles : '';
            var adminOptions = getOptions(adminTitles);

            if ($.inArray(roles['admin'], allSelected) && (lastUnSelected == roles['doctor'] || lastUnSelected == roles['nurse'])) {
                appendOptions(selectTitle, selectProfileTitle, placeholder, adminOptions);
            }

            if (countSelected == 0) {
                appendOptions(selectTitle, selectProfileTitle, placeholder);
            }
        }
    });
});