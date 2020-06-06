<div class="container-fluid">
    <div class="row">
     <div class="col-md-12 card mt-2 p-3 bg-light mb-3">
        <div class="card-body"> 
          <h5 class="card-title text-center">PROFARMA INVOICE</h5>
		  <form action="{{url('/invoices/profarma')}}" method="post" enctype="multipart/form-data">
            @csrf
           <div class="row">
					<div class="col-6 border">
						<div class="form-row">
							<div class="form-group col-12">
								<label for="seller_id" class="col-form-label">Seller</label>
								<select name="seller_id" id="seller_id" class="form-control">
									<option value="">Select</option>
									@foreach (App\Contact::where('user_id',Auth::user()->id)->get() as $item)
								<option value="{{$item->id}}">{{$item->first_name}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-12">
								<label for="buyer_id" class="col-form-label">Buyer</label>
								<select name="buyer_id" id="buyer_id" class="form-control">
									<option value="">Select</option>
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
								<label for="invoice_number" class="col-form-label"
									>Invoice Number</label
								>
								<input
									type="text"
									name="invoice_number"
									id="invoice_number"
									value="INV-{{ App\Invoice::all()->count()+1}}"
									class="form-control"
								/>
							</div>
							<div class="col-6 form-group">
								<label for="date" class="col-form-label">Date</label>
								<input type="date" name="date" id="date" class="form-control" value="{{date('Y-m-d')}}" />
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
									value="{{date('Y-m-d')}}"
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
									<option value="">-</option>
									@foreach (App\Dispatch::all() as $item)
								   <option value="{{$item->id}}">{{$item->name}}</option>
									@endforeach
									
								</select>
							</div>
							<div class="form-group col-6">
								<label for="shipment_type" class="col-form-label">Type 0f Shipment</label>
								<input type="text" name="shipment_type" id="shipment_type" class="form-control">
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
									<option value="">-</option>
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
									<option value="">-</option>
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
									<option value="">Details</option>
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
									id="user_table"
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
										<tr>
											<td><span id="sr_no">1</span></td>
											<td><select name="code[]" id="code1" class="form-control code" data-dependent="product">
											<option value="">Products</option>
											@foreach (App\Product::where('user_id',Auth::user()->id)->get() as $item)
											<option value="{{$item->code}}">{{$item->code}}</option>
											@endforeach
										
											</select></td>
                                            <td><input type="text" name="description[]" id="description1" data-srno="1" class="form-control description" /></td>
                                            <td><input type="text" name="quantity[]" id="quantity1" data-srno="1" class="form-control number_only quantity" /></td>
                                            <td><input type="text" name="unit[]" id="unit1" data-srno="1" class="form-control" /></td>
          
                                           <td><input type="text" name="price[]" id="price1" data-srno="1" class="form-control  number_only price" /></td>
                                           <td><input type="text" name="amount[]" id="amount1" data-srno="1" readonly class="form-control amount" /></td>
                                           <td><button type="button" name="add_row" id="add_row" class="btn btn-success btn-xs add_row">+</button></td>

									    </tr>
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
									<option value="">Details</option>
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
								<option value="">Details</option>
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
									placeholder="place of issue"
								/>
							</div>
							<div class="form-group col-md-4">
								<input
									type="date"
									name="action_date"
									id="action_date"
									value="{{date('Y-m-d')}}"
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
								/>
							</div>
							<div class="form-group col-md-6">
								<input
									type="text"
									name="last_name"
									id="last_name"
									placeholder="Last Name"
									class="form-control"
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
							</div>
						</div>
					</div>
				</div>
        
          <button type="submit" class="btn btn-primary">Create</button>
        </form>
           
        </div>
        
            
      </div>
    
    </div>
</div> 