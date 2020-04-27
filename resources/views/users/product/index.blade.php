@extends('users.product.layouts.master')
@section('title','Inco Docs')

@section('content')
    <!-- Sidenav -->
 @include('users.partials.sidenav')
<div class="main">
    <!-- mainHeader -->
 @include('users.partials.mainHeader')  
 <div class="container">
     <div class="row">
      <div class="text-right">
      <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
     </div>
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="user_table">
           <thead>
            <tr>
                <th >Code</th>
                <th >Description</th>
                <th >Sell Price</th>
                <th >Buy Price</th>
                <th >Unit</th>
                <th >H.S. Code</th>
                <th >Action</th>
            </tr>
           </thead>
       </table>
   </div>
 
 </body>
</html> 

<div id="formModal" class="modal fade" role="dialog">
 <div class="modal-dialog  modal-lg">
  <div class="modal-content">
   <div class="modal-header"> 
     <h4 class="modal-title">Create Contact</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
        </div>
        <div class="modal-body">
         <span id="form_result"></span>
       <form id="sample_form" method="post" enctype="multipart/form-data">
        
        @csrf
        <div class="form-group row">
                        <label for="name" class="col-sm-6 control-label">Code</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="code" name="code">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-6 control-label">Description</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                    </div>
                     <div class="form-group row">
                        <label for="sell_price" class="col-sm-6 control-label">Sell Price</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="sell_price" name="sell_price">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="buy_price" class="col-sm-6 control-label">Buy Price</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="buy_price" name="buy_price">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="unit" class="col-sm-6 control-label">Unit Of Measurement</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="unit" name="unit">
                        </div>
                    </div>
                     <div class="form-group row">
                        <label for="country" class="col-sm-6 control-label">Country Of Origin</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="country" name="country">
                        </div>
                    </div>
                      <div class="form-group row">
                        <label for="hs_code" class="col-sm-6 control-label">H.S. Code</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="hs_code" name="hs_code">
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

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title">Confirmation</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
            </div>
            <div class="modal-body">
                <h4 class="text-center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
            <input type="hidden" name="action" id="action" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <input type="submit" name="ok_button" id="ok_button" class="btn btn-danger" value="Delete" />
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
     </div>
 </div>
    
     
       

@endsection
 </div>   
