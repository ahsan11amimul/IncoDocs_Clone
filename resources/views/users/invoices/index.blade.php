@extends('users.invoices.layouts.master')
@section('title','Which Express')

@section('content')
    <!-- Sidenav -->
 @include('users.partials.sidenav')
<div class="main">
    <!-- mainHeader -->
 @include('users.partials.mainHeader')  
<div class="container">
 <div class="row">
    
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-plus"></i>
            Create New
           </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{url('invoices/create_profarma')}}"><i class="fas fa-plus mr-2"></i>Profarma Invoice</a>
                <a class="dropdown-item" href="{{url('invoices/create_commercial')}}"><i class="fas fa-plus mr-2"></i>Commercial Invoice</a>
                </div>  
        </div>
        <div class="col-md-12">
            <h3 class="text-muted text-center">Invoices</h3>
        </div>
   <div class="table-responsive">
    <table class="table table-hover table-striped table-bordered" id="invoice_table">
           <thead>
            <tr>
                <td class="text-dark">Invoice No</td>
                <td class="text-dark">Buyer</td>
                <td class="text-dark">Status</td>
                <td class="text-dark">Type</td>
                <td class="text-dark">Amount</td>
                <td class="text-dark">Date Created</td>
                <td class="text-dark">Action</td>
            </tr>
           </thead>
       </table>
   </div>
 
  </div>
 </div>
<!-- modals -->
{{-- @include('users.invoices.partials.profarma_modal')
@include('users.invoices.partials.commercial_modal')  --}}
@include('users.invoices.partials.confirm_modal')   

@endsection
 </div>   


 