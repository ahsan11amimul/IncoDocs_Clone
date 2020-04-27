@extends('users.invoices.layouts.master')
@section('title','Inco Docs')

@section('content')
    <!-- Sidenav -->
 @include('users.partials.sidenav')
<div class="main">
    <!-- mainHeader -->
 @include('users.partials.mainHeader')  
<div class="container">
 <div class="row">
    
        <div class="dropdown">
          <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-plus"></i>
            Create New
           </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#profarma"><i class="fas fa-plus mr-2"></i>Profarma Invoice</a>
                    <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#commercial"><i class="fas fa-plus mr-2"></i>Commercial Invoice</a>
                </div>
        </div>
        <div class="col-md-12">
            <h5 class="text-center text-primary">Invoices</h5>
        </div>
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="user_table">
           <thead>
            <tr>
                <th >Invoice No</th>
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
@include('users.invoices.partials.profarma_modal')
@include('users.invoices.partials.commercial_modal') 
@include('users.invoices.partials.confirm_modal')   

@endsection
 </div>   


 