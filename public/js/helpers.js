/**
 * Remove error on inserting the new value.
 *
 * @return void
 */
function removeErrorOnNewInput()
{
    $("input, textarea").on('keydown', function() {

        $(this).removeClass('is-invalid');
        $(this).siblings(".invalid-feedback").hide().text('');
    })

    $("select").on('change', function () {

        $(this).removeClass('is-invalid');
        $(this).siblings(".invalid-feedback").hide().text('');
    });
}

/**
 * Get the roles names.
 *
 * @param  {array} roles
 * @return {array}
 */
function roleNames(roles)
{
    var tempArray = []

    $.each(roles, function(key, value) {

        tempArray.push(value.name)
    })

    return tempArray
}

/**
 * Determine if the user is verified.
 *
 * @param  {string} verified
 * @return {string}
 */
function accountStatus(verified, html1, html2)
{
    return verified == true ? html1 : html2
}


/**
 * Format the date.
 *
 * @param  {string} date
 * @return {string}
 */
function formattedDate(date)
{
    var d = new Date(date);

    var date = d.getDate();
    var month = monthsNames()[d.getMonth()];
    var year = d.getFullYear();

    return date +  " " + month + " " + year;
}

/**
 * Get the months names.
 *
 * @return {array}
 */
function monthsNames()
{
    return [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ]
}

/**
 * Set table counter column
 *
 * @param {object} datatable
 * @return {void}
 */
function datatableCounterColumn(table)
{
    table.on('order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            x = i+1
            cell.innerHTML = '<span>'+ x +'</span>';
        } );
    } ).draw();
}