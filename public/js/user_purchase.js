$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#purchase_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/purchases",
        },
        columns: [
            { data: 'purchase_number', name: 'purchase_number' },
            { data: 'seller', name: 'seller' },
            { data: 'status', name: 'status' },
            { data: 'invoice_total', name: 'invoice_total' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false }
        ]

    });
    var user_id;
    $(document).on('click', '.delete', function () {
        user_id = $(this).attr('id');
        // alert(user_id);
        $('#confirmModal').modal('show');
    });
    $('#ok_button').click(function () {
        $.ajax({
            url: "purchases/destroy/" + user_id,
            beforeSend: function () {
                $('#ok_button').text('Deleting...');
            },
            success: function (data) {
                setTimeout(function () {
                    $('#confirmModal').modal('hide');
                    $('#purchase_table').DataTable().ajax.reload();
                }, 2000);
            }
        })
    });
    $(document).on('click', '.email', function () {
        user_id = $(this).attr('id');
        $('#emailModal').modal('hide');
        $.ajax({
            url: "purchases/getInfo/" + user_id,

            success: function (result) {
                //alert(result.data.invoice_total);
                //alert(result.email);
                $('#number').html(result.data.purchase_number);
                $('#purchase_number').val(result.data.purchase_number);
                $('#total').html(result.data.invoice_total);
                $('#email').val(result.email);
                $('#number1').html(result.data.purchase_number);
                $('#total1').html(result.data.invoice_total);

                $('#emailModal').modal('show');

            }
        })

    })
    $(document).on('click', '.send', function () {
        var email = $('#email').val();
        var purchase_number = $('#purchase_number').val();
        if (email != '') {
            $.ajax({
                url: 'purchases/send',
                datatype: 'json',
                method: 'POST',
                data: { email: email, purchase_number: purchase_number },
                error: function (result) {
                    alert('Error: ' + result.data);
                }, success: function (result) {
                    alert('Success: php ' + result.data);
                }
            })
        }
    })



})