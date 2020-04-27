@extends('users.quotes.layouts.master')
@section('title','Inco Docs')

@section('content')
    <!-- Sidenav -->
 @include('users.partials.sidenav')
<div class="main">
    <!-- mainHeader -->
 @include('users.partials.mainHeader')  
<div class="container">
 <div class="row">
    
        
          <button class="btn btn-primary text-white"  data-toggle="modal" data-target="#quote"><i class="fas fa-plus mr-2"></i>
            Create New
           </button>
               
        <div class="col-md-12">
            <h5 class="text-center text-primary">Quotes</h5>
        </div>
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="user_table">
           <thead>
            <tr>
                <th >Quote No</th>
                <th >Buyer</th>
                <th >Status</th>
                <th >Type</th>
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
@include('users.quotes.partials.quote_modal')
@include('users.quotes.partials.confirm_modal')   

@endsection
 </div>   


 