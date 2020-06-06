@extends('admin.layouts.master')
@section('title')
    Admin Dashboard
@endsection

@section('content') 

<!-- main header-->
 @include('admin.partials.mainHeader')
 <!-- sidebar -->
@include('admin.partials.sidebar') 

<div class="container-fluid">
   

   

   
<!-- Footer -->
@include('admin.partials.footer')   
</div>

@endsection


  