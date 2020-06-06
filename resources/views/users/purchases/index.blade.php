@extends('users.purchases.layouts.master')
@section('title','Inco Docs')

@section('content')
    <!-- Sidenav -->
 @include('users.partials.sidenav')
<div class="main">
    <!-- mainHeader -->
 @include('users.partials.mainHeader')  
<div class="container">
 <div class="row">
    
      
         <div class="col-md-12">
         @if (Session::has('success'))
         <div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert">&times;</button>
         <strong>Success!</strong> {{Session('success')}}
         </div>   
         @endif  
 <a class="btn btn-primary text-white" href="{{url('purchases/create')}}" ><i class="fas fa-plus mr-2"></i>
            Create New
          </a>
               
        <div class="col-md-12">
            <h5 class="text-center text-primary">Purchases</h5>
        </div>
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="purchase_table">
           <thead>
            <tr>
                <th >Purchase Order No</th>
                <th >Seller</th>
                <th >Status</th>
                <th >Amount</th>
                <th >Date Created</th>
                <th >Action</th>
            </tr>
           </thead>
       </table>
   </div>
 
  </div>
 </div>
<!-- modals -->
@include('users.purchases.partials.confirm_modal')   

@endsection
 </div>   
  <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="emailModal">Send</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          
            <div class="form-group row">
               <label for="email" class="col-sm-2 col-form-label">To:</label>
            <div class="col-sm-10">
            <input type="email" class="form-control col-sm-10" id="email" name="email">
            <input type="hidden" name="purchase_number" id="purchase_number">
             </div>
            </div>
             <div class="form-group row">
              <label for="subject" class="col-sm-2 col-form-label">Subject:</label>
              <div class="col-sm-10">
              <p class="col-sm-10 form-control">Purchase Order <span id="number"></span> for <span id="total"></span> need approval.</p>
              
             </div>
            </div>
        </form>
        <div>
          <p>Hi,</p>
          <p>Here is Purchase Order <span id="number1"></span> for <span id="total1"></span> is awaiting your approval. </p>
          <p>View your Purchase Order online: [Online Purchase Order Link]</p>
          <p>From your online Purchase Order you can accept, comment or print.</p>
          <p>If you have any questions, please let me know.</p>
          <p>Thanks,</p>
          <p>{{auth()->user()->name}}</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary send">Send Email</button>
      </div>
    </div>
  </div>
</div> 


 