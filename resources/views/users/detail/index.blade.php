@extends('users.detail.layouts.master')
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
                <th >Name</th>
                <th >Description</th>
                <th >Modified At</th>
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
     <h4 class="modal-title">Create Detail</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
        </div>
        <div class="modal-body">
         <span id="form_result"></span>
       <form id="sample_form" method="post">
        
        @csrf
        <div class="form-group row">
                        <label for="name" class="col-sm-6 control-label">Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-6 control-label">Description</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="description" name="description">
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
