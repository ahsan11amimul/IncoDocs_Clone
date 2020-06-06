@extends('pages.layouts.master')
@section('title')
   Contact Us: WhichExpress
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
     <div class="jumbotron">
      <h1 class="display-4 text-center">Contact our team.</h1>
      <p class="lead">Our team is happy to get back to you and answer any of your questions.
      Fill out the form below and we’ll be in touch as soon as we can.</p>
      <hr class="my-4">
     </div> 
    </div>
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
          <label for="email" class="text-muted">Working Email *</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{old('email')}}" name="email" required autofocus autocomplete="email">
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="name" class="text-muted">Full Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}">
        @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
         <div class="form-group">
            <label for="company_name" class="text-muted">Company Name</label>
         <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{old('company_name')}}">
         @error('company_name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
        </div>
        <div class="form-group">
            <label for="phone" class="text-muted">Phone Number</label>
         <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{old('phone_number')}}">
         @error('phone_number')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
        </div>
          <div class="form-group">
            <label for="message" class="text-muted">How can we help you</label>
            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" value="{{old('message')}}" rows="3"></textarea>
          @error('message')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
          </div>
        <button type="submit"  class="btn btn-primary btn-lg float-right text-white">
            Contact Us 
        </button>
        </form>
 </div> 
  @endif   
 </div>


  <div class="col-md-12 offset-md-none mt-2">
     @include('pages.partials.footer')
  </div>

 
</div>
 
@endsection