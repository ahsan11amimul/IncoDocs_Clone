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
    <title>IncoDocs</title>
</head>
<body>
	@include('users.partials.mainHeader') 
    <div class="container-fluid">
    <div class="row">
     <div class="col-md-12 card mt-2 p-3 bg-light mb-3">
        <div class="card-body"> 
          <h5 class="card-title text-center">EDIT PURCHASE ORDER</h5>
		  <form action="{{ route('purchases.update', $purchase->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
		     <div class="row">
					<div class="col-6 border">
						<div class="form-row">
							<div class="form-group col-12">
								<label for="seller_id" class="col-form-label">Seller</label>
								<select name="seller_id" id="seller_id" class="form-control">
                                <option value="{{$purchase->seller_id??''}}">{{$purchase->seller_id?App\Contact::where('id',$purchase->seller_id)->first()->value('first_name'):'Select'}}</option>
									@foreach (App\Contact::where('user_id',Auth::user()->id)->get() as $item)
								<option value="{{$item->id}}">{{$item->first_name}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-12">
								<label for="buyer_id" class="col-form-label">Buyer</label>
								<select name="buyer_id" id="buyer_id" class="form-control">
                                <option value="{{$purchase->buyer_id??''}}">{{$purchase->buyer_id?App\Contact::where('id',$purchase->buyer_id)->first()->value('first_name'):'Select'}}</option>
									@foreach (App\Contact::where('user_id',Auth::user()->id)->get() as $item)
								<option value="{{$item->id}}">{{$item->first_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-6 border">
						<div class="form-row">
							<div class="col-6 form-group">
								<label for="purchase_number" class="col-form-label"
									>Purchase Number</label
								>
								<input
									type="text"
									name="purchase_number"
									id="purchase_number"
                                    value="{{$purchase->purchase_number}}"
									class="form-control"
								/>
							</div>
							<div class="col-6 form-group">
								<label for="date" class="col-form-label">Date</label>
								<input type="date" name="date" id="date" class="form-control" value="{{$purchase->date??date('Y-m-d')}}" />
							</div>
							<div class="col-6 form-group">
								<label for="buyer_reference" class="col-form-label"
									>Buyer Reference</label
								>
								<input
									type="text"
									name="buyer_reference"
									id="buyer_reference"
                                    class="form-control"
                                    value={{$purchase->buyer_reference}}
								/>
							</div>
							<div class="col-6 form-group">
								<label for="delivery_date" class="col-form-label"
									>Delivery Date</label
								>
								<input
									type="date"
									name="delivery_date"
									id="delivery_date"
                                    value="{{$purchase->delivery_date??date('Y-m-d')}}"
                                
									class="form-control"
								/>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6 border">
						<div class="form-row">
							<div class="form-group col-6">
								<label for="dispatch_id" class="col-form-label"
									>Method Of Dispatch</label
								>
								<select
									name="dispatch_id"
									id="dispatch_id"
									class="form-control"
								>
                            <option value="{{$purchase->dispatch_id??''}}">{{$purchase->dispatch_id?App\Dispatch::where('id',$purchase->dispatch_id)->first()->value('name'):'-'}}</option>
									@foreach (App\Dispatch::all() as $item)
								   <option value="{{$item->id}}">{{$item->name}}</option>
									@endforeach
									
								</select>
							</div>
							<div class="form-group col-6">
								<label for="shipment_type" class="col-form-label">Type 0f Shipment</label>
                            <input type="text" name="shipment_type" id="shipment_type" class="form-control" value="{{$purchase->shipment_type}}">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-6">
								<label for="loading_id" class="col-form-label"
									>Port of Loading</label
								>
								<select
									name="loading_id"
									id="loading_id"
									class="form-control"
								>
									<option value="{{$purchase->loading_id??''}}">{{$purchase->loading_id?App\Place::where('id',$purchase->loading_id)->first()->value('name'):'-'}}</option>
									@foreach (App\Place::all() as $item)
								   <option value="{{$item->id}}">{{$item->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-6">
								<label for="discharge_id" class="col-form-label"
									>Port Of Discharge</label
								>
								<select
									class="form-control"
                                    id="discharge_id"
                                    name="discharge_id"
									class="form-control"
								>
									<option value="{{$purchase->discharge_id??''}}">{{$purchase->discharge_id?App\Place::where('id',$purchase->discharge_id)->first()->value('name'):'-'}}</option>
									@foreach (App\Place::all() as $item)
								   <option value="{{$item->id}}">{{$item->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>

					<div class="col-6 border">
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="payment_method" class="col-form-label"
									>Terms/Method of Payment</label
								>
								<select
									name="payment_method"
									id="payment_method"
									class="form-control"
								>
									<option value="{{$purchase->payment_method??''}}">{{$purchase->payment_method?App\Detail::where('id',$purchase->payment_method)->first()->value('name'):'Detail'}}</option>
									@foreach (App\Detail::where('user_id',Auth::user()->id)->get() as $item)
								   <option value="{{$item->id}}">{{$item->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 border">
						<div class="table-responsive">
							
								<table
									class="table table-bordered table-striped"
									id="purchase_table"
								>
									<thead>
										<tr>
											<th width="5%">#</th>
											<th width="10%">Product Code</th>
											<th width="35%">Description of Goods</th>
											<th width="10%">Unit Quantity</th>
											<th width="10%">Unit Type</th>
											<th width="10%">Price</th>
											<th width="10%">Amount</th>
											<th width="10%">Action</th>
										</tr>
									</thead>
									<tbody>
										
                                        @foreach (App\OrderItem::where('invoice_number',$purchase->purchase_number)->get() as $inv)
									       <tr id="row_id_{{$loop->iteration}}">
											
                                            <td><span id="sr_no">{{$loop->iteration}}</span></td>
                                            <td><select name="code[]" id="code{{$loop->iteration}}" class="form-control code">
											<option value="{{$inv->code}}">{{$inv->code}}</option>
											@foreach (App\Product::where('user_id',Auth::user()->id)->get() as $item)
											<option value="{{$item->code}}">{{$item->code}}</option>
											@endforeach
										
                                            </select></td>
                                            <td><input type="text" name="description[]" id="description{{$loop->iteration}}" value="{{$inv->description}}"  class="form-control description" /></td>
                                            <td><input type="text" name="quantity[]" id="quantity{{$loop->iteration}}" value="{{$inv->quantity}}"  class="form-control number_only quantity" /></td>
                                            <td><input type="text" name="unit[]" id="unit{{$loop->iteration}}" value="{{$inv->unit}}"  class="form-control" /></td>
          
                                           <td><input type="text" name="price[]" id="price{{$loop->iteration}}" value="{{$inv->price}}"  class="form-control  number_only price" /></td>
										   <td><input type="text" name="amount[]" id="amount{{$loop->iteration}}" value="{{$inv->amount}}" readonly class="form-control amount" /></td>
										  
                                           @if ($loop->iteration<2)
											 <td><button type="button" name="add_row" id="add_row" class="btn btn-success btn-xs add_row">+</button></td>  
										   @else
											 <td><button type="button" name="remove_row" id="{{$loop->iteration}}" class="btn btn-danger btn-xs remove_row">X</button></td>  
										   @endif
                                            
                                            </tr>
                                        @endforeach
									</tbody>
								</table>
						
						</div>
					</div>
					<div class="col-12 border">
						<div class="form-group row">
							<label for="total" class="col-sm-6 col-form-label"
								>Consignment Total</label
							>
							<input
								type="text"
								name="quantity_total"
								id="quantity_total"
								class="col-sm-3 form-control"
								readonly
							/>
							<input
								type="text"
								name="total"
                                id="total"
                                value="{{$purchase->total}}"
								class="col-sm-3 form-control"
								readonly
							/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6 border">
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="additional_info" class="col-form-label"
									>Additional Information</label
								>
								<select
									name="additional_info"
									id="additional_info"
									class="form-control"
								>
									<option value="{{$purchase->additional_info??''}}">{{$purchase->additional_info?App\Detail::where('id',$purchase->additional_info)->first()->value('name'):'Details'}}</option>
									@foreach (App\Detail::where('user_id',Auth::user()->id)->get() as $item)
								   <option value="{{$item->id}}">{{$item->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-6 border">
						<div class="form-group row">
							<label for="discount" class="col-sm-4 col-form-label"
								>Discount</label
							>
							<input
								type="text"
								name="discount"
                                id="discount"
                                value="{{$purchase->discount}}"
								class="col-sm-8 form-control discount"
							/>
						</div>
						<div class="form-group row">
							<label for="invoice_total" class="col-sm-4 col-form-label"
								>Invoice Total</label
							>
							<input
								type="text"
								name="invoice_total"
                                id="invoice_total"
                                value="{{$purchase->invoice_total}}"
								class="col-sm-8 form-control"
							/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6 border">
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="bank_detail" class="col-form-label"
									>Bank Details</label
								>
								<select
									name="bank_detail"
									id="bank_detail"
									class="form-control"
								>
                              <option value="{{$purchase->bank_detail??''}}">{{$purchase->bank_detail?App\Detail::where('id',$purchase->bank_detail)->first()->value('name'):'Details'}}</option>
									@foreach (App\Detail::where('user_id',Auth::user()->id)->get() as $item)
								   <option value="{{$item->id}}">{{$item->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-6 border">
						<div class="form-row">
							<div class="form-group col-md-8">
								<input
									type="text"
									name="place"
									id="place"
                                    class="form-control"
                                    value="{{$purchase->place}}"
									placeholder="place of issue"
								/>
							</div>
							<div class="form-group col-md-4">
								<input
									type="date"
									name="action_date"
									id="action_date"
									value="{{$purchase->action_date??date('Y-m-d')}}"
									class="form-control"
									placeholder="date of issue"
								/>
							</div>
							<div class="form-group col-md-12">
								<label for="signatory_company" class="col-form-label"
									>Signatory Company</label
								>
								<input
									type="text"
									name="signatory_company"
									name="signatory_company"
                                    class="form-control"
                                    value="{{$purchase->signatory_company}}"
								/>
							</div>
							<div class="col-md-12">
								<label for="authorised_company" class="col-form-label"
									>Name Of authorised Company</label
								>
							</div>
							<div class="form-group col-md-6">
								<input
									type="text"
									name="first_name"
									id="first_name"
									placeholder="First Name"
                                    class="form-control"
                                    value="{{$purchase->first_name}}"
								/>
							</div>
							<div class="form-group col-md-6">
								<input
									type="text"
									name="last_name"
									id="last_name"
									placeholder="Last Name"
                                    class="form-control"
                                    value="{{$purchase->last_name}}"
								/>
							</div>
							<div class="col-md-12">
								<label for="signature" class="col-form-label">Signature</label>
							</div>
							<div class="col-md-12 form-group">
								<input
									type="file"
									name="signature"
									id="signature"
                                    class="form-control"
                                    
                                />
                               <input type="hidden" class="form-control" id="old_image" name="old_image" value="{{$purchase->signature}}">
							<img src="/storage/{{$purchase->signature}}" alt="image" style="width:150px;height:100px" class="image-thumbnail mb-2">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
				<div class="col-12 offset-11">
					<button class="btn btn-primary btn-sm mb-1" type="submit">Save Changes</button>
				</div>
			    <input type="hidden" name="hidden_id" value="{{$purchase->purchase_number}}">
				
			   </div>
        
        </form>
           
        </div>
        
            
      </div>
    
    </div>
</div> 

</body>
</html>
<script>
	$(document).ready(function(){
		
		var invoice_total = $('#invoice_total').text();
        var count = {{ App\OrderItem::where('invoice_number',$purchase->purchase_number)->get()->count()}};
		//alert('init'+count);
        cal_final_total(count);
        $(document).on('click', '#add_row', function(){
		  count++;
		 
		  alert('add'+count);
          $('#quantity_total').val(count);
          var html_code = '';
          html_code += '<tr id="row_id_'+count+'">';
          html_code += '<td><span id="sr_no">'+count+'</span></td>';
          
		  html_code += '<td><select name="code[]" id="code'+count+'" class="form-control">';
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
          $('#purchase_table').append(html_code);
        });
        
        $(document).on('click', '.remove_row', function(){
          var row_id = $(this).attr("id");
		 // alert($('#row_id_'+row_id));

		 // alert('remove'+row_id);
		  //alert('remove'+count);
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
		$('#code'+count).change(function(){
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
					cal_final_total(count);
					
				},
				error:function(result)
				{
					console.log(result.data);
				}
			})
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

	})
</script>



    