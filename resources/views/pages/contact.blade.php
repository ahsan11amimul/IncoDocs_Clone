@extends('pages.layouts.master')
@section('title')
   IncoDocs:Invoicing platform 
@endsection
@section('content')
<div class="container-fluid">
   <!-- Navbar -->
 @include('pages.partials.navbar') 

  <!-- Jumbroton -->
 <div class="jumbotron">
  <h1 class="display-4 text-center">Contact our team.</h1>
  <p class="lead">Our team is happy to get back to you and answer any of your questions.
Fill out the form below and we’ll be in touch as soon as we can.</p>
  
  <hr class="my-4">
  
 </div>
 <div class="row">
   <div class="col-md-12">
     @if (Session::has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{Session('success')}}!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
            </button>
     </div>
   </div>
        
     @else
    <div class="col-md-6 offset-md-4">
    <form action="{{route('contact')}}" method="POST">
            @csrf
        <div class="form-group">
            <label for="email">Working Email</label>
        <input type="email" class="form-control" id="email" value="{{old('email')}}" name="email" required>
        </div>
        <div class="form-group">
            <label for="name">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
        </div>
         <div class="form-group">
            <label for="company_name">Company Name</label>
         <input type="text" class="form-control" id="company_name" name="company_name" value="{{old('company_name')}}">
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
         <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{old('phone_number')}}">
        </div>
          <div class="form-group">
            <label for="message">How can we help you</label>
          <textarea class="form-control" id="message" name="message" value="{{old('message')}}" rows="3"></textarea>
        </div>
        <button type="submit"  class="btn btn-primary btn-lg float-right text-white">
            Contact Us 
        </button>
        </form>
    </div> 
     @endif
    
 </div>
 
 <div class="row mt-4">
    @include('pages.partials.footer')
 </div>
</div>
 
@endsection