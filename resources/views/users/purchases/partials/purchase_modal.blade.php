<div id="purchase" class="modal fade" role="dialog">
 <div class="modal-dialog  modal-xl">
  <div class="modal-content">
   <div class="modal-header"> 
     <h4 class="modal-title">Purchase Order</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
        </div>
        <div class="modal-body">
         <span id="form_result"></span>
        <form id="sample_form" method="post" enctype="multipart/form-data">
             <div class="row">
                <div class="col-6 border">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="seller" class="col-form-label">From</label>
                            <select name="seller" id="seller" class="form-control">
                                <option value="">Select</option>
                                <option value="1">Option 1</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="seller" class="col-form-label">To</label>
                            <select name="seller" id="seller" class="form-control">
                                <option value="">Select</option>
                                <option value="1">Option 1</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-6 border">
                    <div class="form-row">
                        <div class="col-6 form-group">
                            <label for="purchase_number" class="col-form-label">Purchase Order Number</label>
                            <input type="text" name="purchase_number" id="purchase_number" class="form-control">
                        </div>
                        <div class="col-6 form-group">
                            <label for="date" class="col-form-label">Date</label>
                            <input type="date" name="date" id="date" class="form-control"
                                value=" <?php echo date('Y-m-d');?> ">
                        </div>
                        <div class="col-12 form-group">
                            <label for="supplier_reference" class="col-form-label">Supplier Reference</label>
                            <input type="text" name="supplier_reference" id="suplier_reference" class="form-control">
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 border">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="dispatch_method" class="col-form-label">Method Of Dispatch</label>
                            <select name="dispatch_method" id="dispatch_method" class="form-control">
                                <option value="">-</option>
                                <option value="1">Option 1</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="shipment_type" class="col-form-label">Type 0f Shipment</label>
                            <select class="form-control" id="shipment_type" class="form-control" name="shipment_type">
                                <option value="">-</option>
                                <option value="1">Option 1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="loading_port" class="col-form-label">Port of Loading</label>
                            <select name="loading_port" id="loading_port" class="form-control">
                                <option value="">-</option>
                                <option value="1">Option 1</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="discharge_port" class="col-form-label">Port Of Discharge</label>
                            <select class="form-control" id="discharge_port" class="form-control">
                                <option value="">-</option>
                                <option value="1">Option 1</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-6 border">

                </div>
            </div>
            <div class="row">
                <div class="col-12 border">
                    <div class="table-responsive">
                        <form method="post" id="dynamic_form">
                            <span id="result"></span>
                            <table class="table table-bordered table-striped" id="user_table">
                                <thead>
                                    <tr>
                                        <th width="10%">Product Code</th>
                                        <th width="%40">Description of Goods</th>
                                        <th width="10%">Unit Quantity</th>
                                        <th width="10%">Unit Type</th>
                                        <th width="10%">Price</th>
                                        <th width="10%">Amount</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="col-12 border">
                    <div class="form-group row">
                        <label for="total" class="col-sm-6 col-form-label">Consignment Total</label>
                        <input type="text" name="total" class="col-sm-6 form-control" readonly />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 border">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="additional_info" class="col-form-label">Additional Information</label>
                            <select name="additional_info" id="additional_info" class="form-control">
                                <option value="">-</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-6 border">
                    <div class="form-group row">
                        <label for="discount" class="col-sm-4 col-form-label">Discount</label>
                        <input type="text" name="discount" class="col-sm-8 form-control" />
                    </div>
                    <div class="form-group row">
                        <label for="invoice_total" class="col-sm-4 col-form-label">Invoice Total</label>
                        <input type="text" name="invoice_total" class="col-sm-8 form-control" />
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <input type="text" name="place" id="place" class="form-control"
                                placeholder="place of issue" />
                        </div>
                        <div class="form-group col-md-4">
                            <input type="date" name="action_date" id="action_date" class="form-control"
                                placeholder="date of issue" />
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="signatory_company" class="col-form-label">Signatory Company</label>
                        <input type="text" name="signatory_company" name="signatory_company" class="form-control" />
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="authorised_company" class="col-form-label">Name Of authorised Company</label>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="first_name" id="first_name" placeholder="First Name"
                                class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="last_name" id="last_name" placeholder="Last Name"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="signature" class="col-form-label">Signature</label>
                    </div>
                    <div class="col-md-12 form-group">
                        <input type="file" name="signature" id="signature" class="form-control" />
                    </div>

                </div>
            </div>
         
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <input type="hidden" name="hidden_id" id="hidden_id">
        <input type="submit" class="btn btn-primary" id="action_button" name="action_button" value="Add">
        </div>
      </form>
        
        </div>
     </div>
    </div>
</div>