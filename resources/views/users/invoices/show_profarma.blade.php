
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
    <script src="{{asset('js/user_invoices.js')}}"></script>
    <title>IncoDocs</title>
</head>
<body>
 @include('users.partials.mainHeader')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center">PROFARMA INVOICE</h3>
            </div>
            <div class="col-6 border">
                <p>Seller</p>
                <?php $item=App\Contact::where('id',$invoice->buyer_id)->first();?>
                    <p>{{$item->first_name??''}}{{$item->last_name??''}}</p>
                    <p>{{$item->address??''}},{{$item->city??''}},{{$item->state??''}}</p>
                    <p>{{$item->country??''}},{{$item->state??''}}</p>
                    <p>{{$item->email??''}}</p>
                    <p>{{$item->phone??''}}</p>
                    <p>{{$item->first_name??''}}{{$item->last_name??''}}</p>
            </div>
            <div class="col-6 border">
                <div class="row">
                    <div class="col-12 border-bottom">
                        <p class="float-right">Pages 1 of 1</p>
                    </div>
                </div>
                <div class="row border-bottom">
                    <div class="col-6 border-right">
                        <p>Invoice Number</p>
                        <p>{{$invoice->invoice_number}}</p>
                    </div>
                    <div class="col-6">
                        <p>Date</p>
                        <p>{{$invoice->date}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p>Buyer Reference</p>
                        <p>{{$invoice->buyer_reference}}</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 border">
                    <p>Buyer</p>
                    <?php $item=App\Contact::where('id',$invoice->buyer_id)->first();?>
                    <p>{{$item->first_name??''}}{{$item->last_name??''}}</p>
                    <p>{{$item->address??''}},{{$item->city??''}},{{$item->state??''}}</p>
                    <p>{{$item->country??''}},{{$item->state??''}}</p>
                    <p>{{$item->email??''}}</p>
                    <p>{{$item->phone??''}}</p>
                    <p>{{$item->first_name??''}}{{$item->last_name??''}}</p>
            </div>
            <div class="col-6 border">
                 <p>Delivery Date</p>
                 <p>{{$invoice->delivery_date}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
               <div class="row">
                   <div class="col-6 border">
                       <p>Method of Dispatch</p>
                       <p>{{$invoice->dispatch_id?App\Dispatch::where('id',$invoice->dispatch_id)->first()->value('name'):''}}</p>

                   </div>
                   <div class="col-6 border">
                       <p>Type of Shipment</p>
                       <p>{{$invoice->shipment_type}}</p>
                   </div>
               </div>
               <div class="row">
                   <div class="col-6 border">
                       <p>Port of Loading</p>
                       <p>{{$invoice->loading_id?App\Place::where('id',$invoice->loading_id)->first()->value('name'):''}}</p>
                   </div>
                   <div class="col-6 border">
                        <p>Port of Discharge</p>
                        <p>{{$invoice->discharge_id?App\Place::where('id',$invoice->discharge_id)->first()->value('name'):''}}</p>
                   </div>
               </div>
            </div>
            <div class="col-6 border-right">
                <div class="row">
                    <div class="col-12">
                         <p>Terms / Method of Payment</p>
                         <p>{{$invoice->payment_method?App\Detail::where('id',$invoice->payment_method)->first()->value('description'):''}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border">
           <div class="col-12">
               <div class="table-responsive">
							
								<table
									class="table table-striped table-hover"
									id="user_table"
								>
									<thead>
										<tr>
											<th width="3%">#</th>
											<th width="12%">Product Code</th>
											<th width="30%">Description of Goods</th>
											<th width="15%">Unit Quantity</th>
											<th width="10%">Unit Type</th>
											<th width="10%">Price</th>
											<th width="10%">Amount</th>
											
										</tr>
									</thead>
									<tbody>
                                        <?php
                                        $total_quantity=0;
                                        $total_amount=0;
                                            
                                        ?>
                                        @foreach (App\OrderItem::where('invoice_number',$invoice->invoice_number)->get() as $inv)
									       <tr id="row_id_{{$loop->iteration}}">
                                           
                                           
                                            <td><span id="sr_no">{{$loop->iteration}}</span></td>
                                            <td>{{$inv->code}}</td>
                                            <td>{{$inv->description}}</td>
                                            <td>{{$inv->quantity}}</td> 
                                            <?php $total_quantity+=$inv->quantity ?>
                                            <td>{{$inv->unit}}</td>
                                            <td>{{$inv->price}}</td>
                                           <td>{{$inv->amount}}</td> 
                                           <?php $total_amount+=$inv->amount ?>
                                            </tr>
                                        @endforeach
									</tbody>
								</table>
						
						</div>
           </div>
        </div>
        <div class="row border pt-3">
            <div class="col-6">
             <p class="text-right">Total This Page</p>
            </div>
            <div class="col-2">
            <p class="text-left">{{$total_quantity}}</p>
            </div>
            <div class="col-2">

            </div>
            <div class="col-2">
            <p class="text-center">{{$total_amount}}</p>
            </div>
        </div>
        <div class="row border pt-3">
            <div class="col-6">
              <p class="text-right">Consignment Total</p>
            </div>
            <div class="col-2">
            <p class="text-left">{{$total_quantity}}</p>
            </div>
            <div class="col-2">

            </div>
            <div class="col-2">
            <p class="text-center">{{$total_amount}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-6 border">
                <p>Additional Information</p>
                 <p>{{$invoice->additional_info?App\Detail::where('id',$invoice->additional_info)->first()->value('description'):''}}</p>

            </div>
            <div class="col-6 border">
                <div class="row border-bottom">
                    <div class="col-6 ">
                       <p class="">Discount</p>
                    </div>
                    <div class="col-2">

                    </div>
                    <div class="col-4">
                       <p class="text-center">{{$invoice->discount}}</p>
                    </div>

                </div>
                <div class="row">
                    <div class="col-6">
                       <p>Invoice Total</p>
                    </div>
                    <div class="col-2">

                    </div>
                    <div class="col-4">
                       <p class="text-center">{{$invoice->invoice_total}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 border">
                <p>Bank Details</p>
                <p>{{$invoice->bank_detail?App\Detail::where('id',$invoice->bank_detail)->first()->value('description'):''}}</p>

            </div>
            <div class="col-6">
                <div class="row border-bottom border-right">
                    <div class="col-12">
                        <p>Place and Date of Issue</p>
                    </div>
                    <div class="col-6">
                        <p >{{$invoice->place}}</p>
                    </div>
                    <div class="col-6">
                        <p class="text-right">{{$invoice->action_date}}</p>
                    </div>
                </div>
                <div class="row border-right border-bottom">
                    <div class="col-12">
                        <p>Signature Company</p>
                        <p>{{$invoice->signatory_company}}</p>
                    </div>
                </div>
                <div class="row border-right border-bottom">
                    <div class="col-12">
                        <p>Name of Authorized Company</p>
                    </div>
                    <div class="col-6">
                    <p>{{$invoice->first_name}}</p>
                    </div>
                    <div class="col-6">
                     <p>{{$invoice->last_name}}</p>
                    </div>
                </div>
                <div class="row border-right border-bottom">
                    <div class="col-12">
                        <p>Signature</p>
                        <img src="/storage/{{$invoice->signature}}" alt="image" style="width:150px;height:100px" class="image-thumbnail mb-2">
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
<script>
	$(document).ready(function(){
		
    });
</script>



    