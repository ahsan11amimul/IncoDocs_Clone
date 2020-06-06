$(document).ready(function () {
    //alert('invoice');
    $('#invoice_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/invoices",
        },
        columns: [
            { data: 'invoice_number', name: 'invoice_number' },
            { data: 'buyer', name: 'buyer' },
            { data: 'status', name: 'status' },
            { data: 'type', name: 'type' },
            { data: 'invoice_total', name: 'invoice_total' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false }
        ]

    });
    var user_id;
    $(document).on('click', '.delete', function () {
        user_id = $(this).attr('id');
        $('#confirmModal').modal('show');
    });
    $('#ok_button').click(function () {
        $.ajax({
            url: "invoices/destroy/" + user_id,
            beforeSend: function () {
                $('#ok_button').text('Deleting...');
            },
            success: function (data) {
                setTimeout(function () {
                    $('#confirmModal').modal('hide');
                    $('#invoice_table').DataTable().ajax.reload();
                }, 2000);
            }
        })
    });



})