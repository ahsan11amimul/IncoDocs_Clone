$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#btn-submit').click(function (e) {
        e.preventDefault();
        $('#btn-submit').html('Sending....');
        //alert($('#userForm').serialize());
        $.ajax({
            url: '' + '/invitation',
            type: 'POST',
            data: $('#userForm').serialize(),
            dataType: 'json',
            success: function (data) {
                var user = '<tr>' + '<td>' + data.email + '</td><td>' + data.role + '</td><td>' + data.status + '</td></tr>';
                $('#user_table').prepend(user);
                $('#userForm').trigger('reset');

            },
            error: function (data) {
                console.log(data);
            }

        })

    });
});