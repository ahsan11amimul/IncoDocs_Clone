@extends('pages.layouts.master')
@section('title')
   WhichExpress : Modern Importing & Exporting platform
@endsection
@section('content')
<div class="container-fluid">
   <!-- Navbar -->
 @include('pages.partials.navbar') 
  <div class="row" style="margin-top: 100px;">
     <div class="col-md-12 text-center">
         <a href="#" class="text-white d-block py-2" style="background-color: rgb(64, 66, 163)">Running Your Export Business Remotely During COVID-19 Pandemic. Learn more</a>
     </div>
 </div>
  <!-- Jumbroton -->
 <div class="row">
  <div class="col-md-12">
   <div class="jumbotron jumbotron-fluid">
  <div class="container">
   <h1 class="display-5 text-center">1 Place to Track and Manage Your Purchases.</h1>
    <p class="lead text-center">Streamline your Purchasing process. Connect with your
         suppliers to share, accept and countersign Purchase Orders, Sales Contracts & Proforma Invoices, 100% online.</p>
  </div>
</div>
  </div>
 </div>
 
<div class="container">
 <div class="row">
     <div class="col-md-6">
        <h4>Digitally Countersign Purchase Orders, Sales Contracts and Proforma Invoices.</h4> 
        <p>Keep deals moving with digital signatures. Suppliers click to accept, countersign and create a Invoices in 1-click.</p>
     </div>
    
     <div class="col-md-6">
        <h4>Click to Pay your Supplier Invoices Online.</h4> 
        <p>Suppliers click to accept your Purchase Orders and send back a Proforma Invoice that you can pay by Credit Card, ACH or T/T SWIFT transfer.</p>
     </div>
 </div>
</div>
   @include('pages.partials.footer')
</div>
 
@endsection