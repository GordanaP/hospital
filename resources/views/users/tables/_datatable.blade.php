var datatable = table.DataTable({
    "ajax": {
        "url": accountsUrl,
        "type": "GET"
    },
    "pagingType": "full_numbers",
    "deferRender": true, // Increase the speed of the table loading
    "columns": [
        {
            render: function(data, type, row, meta) {
                return ''
            },
            searchable: false,
            orderable: false
        },
        {
            data: 'name',
            render: function(data, type, row, meta) {
                return '<a href="#" class="text-red-light">' + data +'</a>'
            }
        },
        { data: 'email' },
        {
            data: 'roles',
            render: function(data, type, row, meta) {
                return roleNames(data).length > 0 ? roleNames(data) + ' <a href="#" data-user="' + row.id + '" data-name="' + row.name + '" id="editRoles">Revoke</a>' : '';
            }
        },
        {
            data: 'verified',
            render: function(data, type, row, meta) {

                var html1 = '<i class="fa fa-check text-green mr-2"></i> verified'
                var html2 = '<i class="fa fa-times text-red-light mr-2"></i> inactive'

                return accountStatus(data, html1, html2)
            }
        },
        {
            data: 'created_at',
            render: function(data, type, row, meta) {
                return formattedDate(data)
            }
        },
        {
            data: 'updated_at',
            render: function(data, type, row, meta) {
                return formattedDate(data)
            }
        },
        {
          render: function(data, type, row, meta) {
            return '<div><button class="btn btn-xs btn-edit" id="editAccount" value="' + row.id + '"><i class="icon icon-note mr-3 text-red hover:text-red-darker"></i></button><button class="btn btn-xs btn-link btn-primary btn-link-delete" id="deleteAccount" value="' + row.id + '"><i class="icon icon-trash text-red-dark hover:text-red-darker"></i></button>'
          },
          searchable: false,
          sortable: false,
        },
        {
            data: 'id',
            visible: false
        },
        // {
        //     data: 'profile.slug',
        //     visible: false
        // },
    ],
    "order": [[1, 'asc']],
    responsive: true,
    columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: 1 },
        { responsivePriority: 3, targets: 2 }
    ],
});

// The first col counters the rows
datatableIndexColumn(datatable, table)

$("#accountsTable_length select, #accountsTable_filter input").addClass('admin-modal-input')