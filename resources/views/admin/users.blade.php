@extends('admin.layouts.user')
@section('title')
    Admin Dashboard
@endsection    

@section('content') 
<div class="container-fluid">
<!-- main header-->
 @include('admin.partials.mainHeader')
 <!-- sidebar -->
<div class="row">
    <div class="col-md-12">
      <div class="text-right">
      <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create User</button>
    </div>
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="user_table">
           <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                
                <th>Last Modified</th>
                <th>Action</th>
            </tr>
           </thead>
       </table>
   </div>
    </div>
    
   
 </div>
<!-- modal -->
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
<!-- Create modal -->
<div id="formModal" class="modal fade" role="dialog">
 <div class="modal-dialog  modal-lg">
  <div class="modal-content">
   <div class="modal-header"> 
     <h4 class="modal-title">Create New User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
        </div>
        <div class="modal-body">
        <span id="form_result"></span>
       <form id="sample_form" method="post">
        
        @csrf
        <div class="form-group row">
        <label for="name" class="col-sm-6 text-right">Name</label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="name" name="name">
        </div>
        </div>
        <div class="form-group row">
        <label for="email" class="col-sm-6 text-right">Email</label>
        <div class="col-sm-6">
        <input type="email" class="form-control" id="email" name="email">
        </div>
        </div>
        <div class="form-group row">
        <label for="password" class="col-sm-6 text-right">Password</label>
        <div class="col-sm-6">
        <input type="password" class="form-control" id="password" name="password">
        </div>
        </div>
        <div class="form-group row">
        <label for="type" class="col-sm-6 text-right">User Type</label>
        <div class="col-sm-6">
        <select name="is_admin" id="is_admin" class="form-control">
            <option value="">User Type</option>
            <option value="0">User</option>
            <option value="1">Admin</option>
        </select>
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


   

 



   

   
<!-- Footer -->
@include('admin.partials.footer')   
</div>

@endsection


  