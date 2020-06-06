@extends('pages.layouts.master')
@section('title')
   Quoting for Exporter & Importer
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
            <h1 class="display-5 text-center">Create & Share Quotes that close more deals.</h1>
            <p class="lead text-center">Give your team the tools they need to close more deals and get paid faster.
         Track when quotes are viewed, accepted and signed online.</p>
         </div>
      </div> 
     </div>
  </div>
 
 
<div class="container">
 <div class="row">
     <div class="col-md-4">
        <h4>Create & send quotes with all the information required for import & export.</h4> 
        <p>Create professional Quotes with fields for Incoterms®, ports, multi-currencies and everything required for import & export.</p>
     </div>
     <div class="col-md-4">
        <h4>View the status of your quotes in real-time – view when they have been sent, accepted and signed.</h4> 
        <p>IncoDocs sends quotes via smart e-mails so you know when a quote has been sent, received and opened by your potential new customer.</p>
     </div>
     <div class="col-md-4">
        <h4>Keep deals moving. Allow your customers to create Purchase Orders in 1 click.</h4> 
        <p>Give your customers a tool to create a Purchase Order back to you to keep deals moving.  Convert your Quotes into Proforma or Commercial Invoices in 1 click.</p>
     </div>
 </div>
</div>
   @include('pages.partials.footer')
</div>
 
@endsection