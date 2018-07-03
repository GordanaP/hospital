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