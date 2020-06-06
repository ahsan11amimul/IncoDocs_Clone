@extends('users.contact.layouts.master')
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
                <th width="20%">Name</th>
                <th width="20%">Company</th>
                <th width="20%">Email</th>
                <th width="20%">Last Modified</th>
                <th width="20%">Action</th>
            </tr>
           </thead>
       </table>
   </div>
 
 

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
        <label for="company_name" class="col-sm-6 text-right">Company Name</label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="company_name" name="company_name" value="{{old('company_name')}}">
        </div>
      
       </div>
        <div class="form-group row">
        <label for="logo" class="col-sm-6 text-right">Logo</label>
        <div class="col-sm-6">
        <input type="file" class="form-control" id="logo" name="logo" value="{{old('logo')}}">
        <span id="store_image"></span>
        </div>
       
       </div>
       <div class="row">
         <div class="col-sm-12">
           <h5 class="modal-title">Primary Contact</h5>
           <hr>
           
         </div>
       </div>
       <div class="form-group row">
         <label for="first_name" class="col-sm-6 text-right">First Name</label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="first_name" name="first_name" value="{{old('first_name')}}">
        </div>
       
       </div>
       <div class="form-group row">
         <label for="last_name" class="col-sm-6 text-right">Last Name</label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="last_name" name="last_name" value="{{old('last_name')}}">
        </div>
       
       </div>
       <div class="form-group row">
         <label for="email" class="col-sm-6 text-right">Email</label>
        <div class="col-sm-6">
        <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
        </div>
        
       </div>
       <div class="form-group row">
         <label for="phone" class="col-sm-6 text-right">Phone Number</label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
        </div>
        
       </div>
       <div class="row">
         <div class="col-sm-12">
           <h5 class="modal-title">Street Address</h5>
           <hr>
           
         </div>
       </div>
       <div class="form-group row">
         <label for="address" class="col-sm-6 text-right">Address</label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}">
        </div>
       
       </div>
       <div class="form-group row">
         <label for="city" class="col-sm-6 text-right">City</label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}">
        </div>
       
       </div>
       <div class="form-group row">
         <label for="state" class="col-sm-6 text-right">State/Territory</label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="state" name="state" value="{{old('state')}}">
        </div>
       
       </div>
       <div class="form-group row">
         <label for="country" class="col-sm-6 text-right">Country</label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="country" name="country" value="{{old('country')}}">
        </div>
        
       </div>
        <div class="form-group row">
         <label for="zip" class="col-sm-6 text-right">Zip Code</label>
        <div class="col-sm-6">
        <input type="number" class="form-control" id="zip" name="zip" value="{{old('zip')}}">
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
