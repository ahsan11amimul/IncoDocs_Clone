  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('cdn/font-awesome/all.css')}}">
    <link rel="stylesheet" href="{{ asset('cdn/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('cdn/datatables.css')}}">
	<link rel="stylesheet" href="{{ asset('css/user_index.css')}}">
    <script src="{{asset('cdn/jquery.js')}}"></script>
    <script src="{{asset('cdn/popper.js')}}"></script>
	<script src="{{asset('cdn/bootstrap.js')}}"></script>
	<script src="{{asset('cdn/datatables.js')}}"></script>
	<script src="{{asset('cdn/boot_datatables.js')}}"></script>
	<script src="{{asset('js/user_purchase.js')}}"></script>
    <title>Which Express</title>
</head>
<body>
	@include('users.partials.mainHeader') 
    @include('users.purchases.partials.form')

</body>
</html>
<script>
	$(document).ready(function(){
		
		var invoice_total = $('#invoice_total').text();
        var count = 1;
        
        $(document).on('click', '#add_row', function(){
		  count++;
		 // alert(count);
          //$('#quantity_total').val(count);
          var html_code = '';
          html_code += '<tr id="row_id_'+count+'">';
          html_code += '<td><span id="sr_no">'+count+'</span></td>';
          
		  html_code += '<td><select name="code[]" id="code'+count+'" class="form-control code">';
		  html_code+='<option value="">Products</option>';
		  html_code+='@foreach(App\Product::where('user_id',Auth::user()->id)->get() as $item)';
		  html_code+='<option value="{{$item->code}}">{{$item->code}}</option>@endforeach';
		  html_code+='</select></td>';
          
          html_code += '<td><input type="text" name="description[]" id="description'+count+'" data-srno="'+count+'" class="form-control  description" /></td>';
          html_code += '<td><input type="text" name="quantity[]" id="quantity'+count+'" data-srno="'+count+'" class="form-control number_only quantity" /></td>';
          html_code += '<td><input type="text" name="unit[]" id="unit'+count+'" data-srno="'+count+'" class="form-control" /></td>';
          
          html_code += '<td><input type="text" name="price[]" id="price'+count+'" data-srno="'+count+'" class="form-control  number_only price" /></td>';
          html_code += '<td><input type="text" name="amount[]" id="amount'+count+'" data-srno="'+count+'" readonly class="form-control amount" /></td>';
          html_code += '<td><button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-xs remove_row">X</button></td>';
          html_code += '</tr>';
          $('#user_table').append(html_code);
        });
        
        $(document).on('click', '.remove_row', function(){
          var row_id = $(this).attr("id");
          var amount = $('#amount'+row_id).val();
          var final_amount = $('#invoice_total').text();
          var result_amount = parseFloat(final_amount) - parseFloat(amount);
          $('#invoice_total').text(result_amount);
          $('#total').text(result_amount);
          $('#row_id_'+row_id).remove();
          count--;
		 //$('#quantity_total').val(count);
		 cal_final_total(count);
        });

        function cal_final_total(count)
        {
        
		  var total=0;
		  var invoice_total=0;
		  var quantity_total=0;
		
		  var discount=0;
          for(j=1; j<=count; j++)
          {
            var quantity = 0;
            var price = 0;
			var amount=0;
            quantity = $('#quantity'+j).val();
            if(quantity > 0)
            {
              price = $('#price'+j).val();
              if(price > 0)
              {
                amount = parseFloat(quantity) * parseFloat(price);
                $('#amount'+j).val(amount);
               
                quantity_total+=parseFloat(quantity);
				total+=parseFloat(amount);
				
				invoice_total+=parseFloat(amount);
				}
            }
		  }
		 var discount=parseFloat($("#discount").val());
		 if(discount>0)
		 {   
			 var temp=invoice_total;
			 invoice_total=invoice_total-discount;
			 if(invoice_total<=0)
			 {
				 alert('discount value must be less than total value');
				 $('#discount').val(0);
				 invoice_total=temp;

			 }
		 }
		  $('#total').val(total);
		  $('#quantity_total').val(quantity_total);
          $('#invoice_total').val(invoice_total);
        }

        $(document).on('blur', '.price', function(){
          cal_final_total(count);
		});
		 $(document).on('blur', '.quantity', function(){
          cal_final_total(count);
        });
		 $(document).on('blur', '.discount', function(){
          cal_final_total(count);
        });
		 $(document).on('blur','.code',function(){
			console.log($('#code'+count).val());
			var product_code=$('#code'+count).val();  
			//alert(product_code);
			var id=count;
			$.ajax({
				url:"/invoices/get_product",
				method:"GET",
				dataType:"json",
				data:{product_code:product_code},
				success:function(result)
				{
					$('#description'+id).val(result.data.description);
					$('#price'+id).val(result.data.sell_price);
					$('#unit'+id).val(result.data.unit);
					
				},
				error:function(result)
				{
					console.log(result.data);
				}
			});
		});

	// $('.number_only').keypress(function(e){
	// 	alert('hi');
    //     return isNumbers(e, this);});

    // function isNumbers(evt, element) 
    // {
    //    var charCode = (evt.which) ? evt.which : event.keyCode;
    //  if ((charCode != 46 || $(element).val().indexOf('.') != -1) && (charCode < 48 || charCode > 57))
    //         return false;
    //     return true;
    // }

	});
</script>



    