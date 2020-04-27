@extends('users.layouts.master')
@section('title','Inco Docs')

@section('content')
    <!-- Sidenav -->
    @include('users.partials.sidenav')
    <div class="main">
    <!-- mainHeader -->
      @include('users.partials.mainHeader')  
       <!-- Dummy design -->
      <div class="jumbotron jumbotron-fluid">
        <div class="container-fluid">
            <h1 class="display-6 text-primary text-center">Getting Started With IncoDocs</h1>
            
        </div>
      </div> 
      <div class="container">
          <div class="row">
              <div class="col-md-10 offset-1">
                   <div class="h-80 w-100 mt-3 border border-primary">
                    <p class="p-4 first">Send & Track Invoices</p>
                    <a href="#"  class="d-none">Go to Invoice</a>
                    </div>
                    <div class="h-80 w-100 mt-3 border border-primary">
                    <p class="p-4 second">Create export documents for a shipment</p>
                    <a href="#"  class="d-none">Go to Invoice</a>
                    </div>
                    <div class="h-80 w-100 mt-3 border border-primary">
                    <p class="p-4 third">Send professional export quotes </p>
                    <a href="#"  class="d-none">Go to Invoice</a>
                    </div>
                    <div class="h-80 w-100 mt-3 border border-primary">
                    <p class="p-4 four">Manage your purchase Order</p>
                    <a href="#"  class="d-none">Go to Invoice</a>
                    </div> 
              </div>
          </div>
      </div> 
       
    </div>
@endsection
    
