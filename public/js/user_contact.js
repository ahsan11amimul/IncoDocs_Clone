$(document).ready(function () {

    $('#user_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/contacts",
        },
        columns: [
            {
                data: 'first_name',
                name: 'first_name'
            },

            {
                data: 'company_name',
                name: 'company_name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'updated_at',
                name: 'updated_at'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            }
        ]
    });

    $('#create_record').click(function () {

        $('#action_button').val("Add");
        $('#action').val("Add");
        $('#formModal').modal('show');
    });

    $('#sample_form').on('submit', function (event) {
        event.preventDefault();
        if ($('#action').val() == 'Add') {
            $.ajax({
                url: "/contacts" + "/store",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    var html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (var count = 0; count < data.errors.length; count++) {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#sample_form')[0].reset();
                        $('#user_table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
                }
            })
        }

        if ($('#action').val() == "Edit") {
            $.ajax({
                url: "/contacts" + "/update",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    var html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (var count = 0; count < data.errors.length; count++) {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#sample_form')[0].reset();
                        $('#store_image').html('');
                        $('#user_table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
                }
            });
        }
    });

    $(document).on('click', '.edit', function () {
        var id = $(this).attr('id');
        $('#form_result').html('');
        $.ajax({
            url: "/contacts/" + id + "/edit",
            dataType: "json",
            success: function (html) {
                $('#company_name').val(html.data.company_name);
                $('#store_image').html("<img src=images/" + html.data.logo + " width='70' class='img-thumbnail' />");
                $('#store_image').append("<input type='hidden' name='hidden_image' value='" + html.data.logo + "' />");
                $('#first_name').val(html.data.first_name);
                $('#last_name').val(html.data.last_name);
                $('#email').val(html.data.email);
                $('#phone').val(html.data.phone);

                $('#address').val(html.data.address);
                $('#country').val(html.data.country);
                $('#city').val(html.data.city);
                $('#state').val(html.data.state);
                $('#zip').val(html.data.zip);


                $('#hidden_id').val(html.data.id);
                $('.modal-title').text("Edit New Record");
                $('#action_button').val("Edit");
                $('#action').val("Edit");
                $('#formModal').modal('show');
            }
        })
    });

    var user_id;

    $(document).on('click', '.delete', function () {
        user_id = $(this).attr('id');
        $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function () {
        $.ajax({
            url: "contacts/destroy/" + user_id,
            beforeSend: function () {
                $('#ok_button').text('Deleting...');
            },
            success: function (data) {
                setTimeout(function () {
                    $('#confirmModal').modal('hide');
                    $('#user_table').DataTable().ajax.reload();
                }, 2000);
            }
        })
    });

});