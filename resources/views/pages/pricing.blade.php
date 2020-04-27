@extends('pages.layouts.master')
@section('title')
   Pricing : IncoDocs
@endsection
@section('content')
<div class="container-fluid">
   <!-- Navbar -->
 @include('pages.partials.navbar') 

  <!-- Jumbroton -->
 
 <div class="jumbotron jumbotron-fluid">
  <div class="container">
   <h1 class="display-5 text-center">Pricing Plans</h1>
    <p class="lead text-center">Start with a 14 day free trial or sign up to our free plan.</p>
  </div>
</div>
<div class="container">
 <div class="row">
     <div class="col-md-4">
       <div class="card" style="width: 18rem;"> 
           <h2 class="card-header text-center">
                FREE
           </h2>
            
           <div class="card-body">
            <h5 class="card-title text-center text-muted">$0</h5>
            <ul class="list-group list-group-flush">
            <li class="list-group-item">Unlimited Sales Documents</li>
            <li class="list-group-item">All Shipping Documents</li>
            <li class="list-group-item">Unlimited Contacts</li>
            <li class="list-group-item">Digital Signatures</li>
            <li class="list-group-item">Digital Samps / Seals</li>
            <li class="list-group-item">Up to 3 Users</li>
            <li class="list-group-item">10 Shipments / Month</li>
            </ul>  
           <a href="{{url('/register')}}" class="btn btn-primary m-3 text-white">Get Started</a>
           </div>
           
        </div>
     </div>
     <div class="col-md-4">
       <div class="card" style="width: 18rem;"> 
           <h2 class="card-header text-center">
               PROFESSIONAL
           </h2>
            
           <div class="card-body">
            <h5 class="card-title text-center text-muted">$199 / Month</h5>
            <ul class="list-group list-group-flush">
            <li class="list-group-item">Up to 10 Users</li>
            <li class="list-group-item">Data Import / Export</li>
            <li class="list-group-item">Import Contacts & Products</li>
            <li class="list-group-item">Remove Watermark</li>
            <li class="list-group-item">Multiple Workspaces</li>
            <li class="list-group-item">Custom Documents</li>
            <li class="list-group-item">Premium Support</li>
            </ul>  
           <a href="{{url('/register')}}" class="btn btn-primary m-3 text-white">Try Free 14 days</a>
           </div>
           
        </div>
     </div>
     <div class="col-md-4">
       <div class="card" style="width: 18rem;"> 
           <h2 class="card-header text-center">
                ENTERPRISE
           </h2>
            
           <div class="card-body">
            <h5 class="card-title text-center text-muted">CONTACT US</h5>
            <ul class="list-group list-group-flush">
            <li class="list-group-item">Unlimited Users</li>
            <li class="list-group-item">Unlimited Shipments</li>
            <li class="list-group-item">Third-Party Integrations</li>
            <li class="list-group-item">Workflow Automations</li>
            <li class="list-group-item">Digital Samps / Seals</li>
            <li class="list-group-item">Up to 3 Users</li>
            <li class="list-group-item">10 Shipments / Month</li>
            </ul>  
           <a href="{{url('/contact')}}" class="btn btn-primary m-3 text-white">Contact Us</a>
           </div>
           
        </div>
     </div>
 </div>
</div>
   @include('pages.partials.footer')
</div>
 
@endsection