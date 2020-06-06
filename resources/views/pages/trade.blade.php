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
   <h1 class="display-5 text-center">WhichExpress Blog</h1>
    <p class="lead text-center">Give your team the tools they need to close more deals and get paid faster.
Track when invoices are viewed, accepted, signed and paid.</p>
  </div>
</div> 
    </div>
 </div>

<div class="container">
 <div class="row">
     <div class="col-md-4">
        <h4>Create Proforma Invoices & Commercial Invoices.</h4> 
        <p>IncoDocs does what others tools can’t. It creates two types of invoices: pro forma invoices & commercial invoices.</p>
     </div>
     <div class="col-md-4">
        <h4>Digital signatures & counter-signatures.</h4> 
        <p>Get your deals moving quickly with digital signatures. You can also get a counter-signature.</p>
     </div>
     <div class="col-md-4">
        <h4>Quick to create. Easy to send. Always up to date.</h4> 
        <p>Quote to invoice in seconds. Send with smart e-mail that shows if an invoice has been sent and viewed.</p>
     </div>
 </div>
</div>
   @include('pages.partials.footer')
</div>
 
@endsection