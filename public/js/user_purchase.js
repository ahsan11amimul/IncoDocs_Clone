$(document).ready(function () {
    //alert('invoice');
    function myFunction() {
        var quantity = $('#quantity').val();
        var price = $('#price').val();
        var total = quantity * price;
        $('#amount').val(total);
    }
    var count = 1;

    dynamic_field(count);

    function dynamic_field(number) {
        html = '<tr>';
        html +=
            '<td><input type="text" name="code[]" class="form-control" /></td>';
        html +=
            '<td><input type="text" name="description[]" class="form-control" /></td>';
        html +=
            '<td><input type="number" name="quantity[]" class="form-control" id="quantity" min="1" /></td>';
        html +=
            '<td><input type="text" name="unit[]" class="form-control" /></td>';
        html +=
            '<td><input type="number" name="price[]" class="form-control" id="price" onfocusout="myFunction()" /></td>';
        html +=
            '<td><input type="number" name="amount[]" class="form-control" id="amount" min="1"  readonly/></td>';

        if (number > 1) {
            html +=
                '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
            $('tbody').append(html);
        } else {
            html +=
                '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
            $('tbody').html(html);
        }
    }

    $(document).on('click', '#add', function () {
        count++;
        dynamic_field(count);
    });

    $(document).on('click', '.remove', function () {
        count--;
        $(this).closest('tr').remove();
    });
})