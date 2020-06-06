$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#quote_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/quotes",
        },
        columns: [
            { data: 'quote_number', name: 'quote_number' },
            { data: 'buyer', name: 'buyer' },
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
            url: "quotes/destroy/" + user_id,
            beforeSend: function () {
                $('#ok_button').text('Deleting...');
            },
            success: function (data) {
                setTimeout(function () {
                    $('#confirmModal').modal('hide');
                    $('#quote_table').DataTable().ajax.reload();
                }, 2000);
            }
        })
    });
    $(document).on('click', '.email', function () {
        user_id = $(this).attr('id');
        $('#emailModal').modal('hide');
        $.ajax({
            url: "quotes/getInfo/" + user_id,

            success: function (result) {
                //alert(result.data.invoice_total);
                //alert(result.email);
                $('#number').html(result.data.quote_number);
                $('#quote_number').val(result.data.quote_number);
                $('#total').html(result.data.invoice_total);
                $('#email').val(result.email);
                $('#number1').html(result.data.quote_number);
                $('#total1').html(result.data.invoice_total);

                $('#emailModal').modal('show');

            }
        })

    })
    $(document).on('click', '.send', function () {
        var email = $('#email').val();
        var quote_number = $('#quote_number').val();
        if (email != '') {
            $.ajax({
                url: 'quotes/send',
                datatype: 'json',
                method: 'POST',
                data: { email: email, quote_number: quote_number },
                error: function (result) {
                    alert('Error: ' + result.data);
                }, success: function (result) {
                    alert('Success: php ' + result.data);
                }
            })
        }
    })



})