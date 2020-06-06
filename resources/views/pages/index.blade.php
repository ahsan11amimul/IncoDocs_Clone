@extends('pages.layouts.master')
@section('title')
IncoDocs: Free Cloud Invoicing & Export Documentation Tool
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

  

<div class="row mt-5">
<div class="col-md-12">
         <!-- Jumbroton -->
 <div class="jumbotron">
  <h1 class="display-4 text-center">A thoroughly modern sales & shipping tool made just for importers & exporters.</h1>
  
  <hr class="my-4">
  <div class="text-center">
  <a class="btn btn-primary" href="{{url('/register')}}" role="button">Get Started Free</a>
  <a class="btn btn-outline-info" href="{{url('/contact')}}" role="button">Contact Sales</a>
  </div>
  
 </div>
     </div>
 </div>
  
 <div class="row">
     <div class="col-md-4 text-center border-right p-4">
         <h5>Quoting</h5>
         <p>Create and Share Professional Quotes that close deals fast.</p>
         <h5>Invoicing</h5>
         <p>Create and Share Proforma Invoices & Commercial Invoices to get paid faster.</p>
     </div>
     <div class="col-md-4 text-center border-right p-4">
         <h5>Purchasing</h5>
         <p>Connect with suppliers to track & manage Purchase Orders & Sales Contracts.</p>
          <h5>Shipping Documents</h5>
         <p>Create sets of export documents without re-typing any information.</p>
     </div>
     
     <div class="col-md-4 text-center border-right p-4">
         <h5>View And accept tracking</h5>
         <p>Know when your recipient has viewed and accepted your document.</p>
         <h5>Digital Countersigning</h5>
         <p>Buyers and Sellers digitally sign and stamp documents, 100% online.</p>
     </div>
     
 </div>
 <div class="row">
     <div class="col-md-12 text-center">
         <h1>Customers in over 120+ countries</h1>
         <p class="lead">Companies of all sizes and industries use IncoDocs to upgrade their operations.</p>
     </div>
     <div class="col-md-4 p-5">
         <img src="https://incodocs.com/wp-content/uploads/2020/02/thumbnail-cupral.jpg" alt="" class=" img-fluid img-thumbnail h-50">
         <p class="lead">Scaling their global operations team and tapping into new markets around the world.</p>
         <a href="#" class="btn btn-outline-secondary btn-lg">Learn More</a>
     </div>
     <div class="col-md-4 p-5">
         <img src="https://incodocs.com/wp-content/uploads/2020/02/thumbnail-miir.jpg" alt="" class=" img-fluid img-thumbnail h-50">
         <p class="lead">Scaling their global operations team and tapping into new markets around the world.</p>
         <a href="#" class="btn btn-outline-secondary btn-lg">Learn More</a>
     </div>
     <div class="col-md-4 p-5">
         <img src="https://incodocs.com/wp-content/uploads/2020/02/thumbnail-wwe.jpg" alt="" class=" img-fluid img-thumbnail h-50">
         <p class="lead">Scaling their global operations team and tapping into new markets around the world.</p>
         <a href="#" class="btn btn-outline-secondary btn-lg">Learn More</a>
         
     </div>
 </div>
 <div class="row">
     <div class="col-md-6">
         <h1>Get started in minutes.</h1>
         <p class="lead text-muted">Sign up for free and get started without any training. No credit card required.</p>
     </div>
     <div class="col-md-3">

     </div>
     <div class="col-md-3">
     <a href="{{url('/register')}}" class="btn btn-primary text-white btn-lg">Get Started For free</a>
     </div>
 </div>
 <!-- Footer -->
  @include('pages.partials.footer')


</div>
 
@endsection