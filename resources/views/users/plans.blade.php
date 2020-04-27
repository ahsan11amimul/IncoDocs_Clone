@extends('pages.layouts.master')
@section('title','Inco Docs')
@section('content')
<div class="container">
    <div class="row justify-content-center m-auto">
        <div class="col-md-8">
            <div class="card mt-5">
                 <a href="{{ url('/user/dashboard')}}" class="text-dark text-left">
                    <i class="fas fa-arrow-alt-circle-left"></i>
                    Back Home
                </a>
                <h3 class="card-header text-center">Plans & Billing</h3>
                <p class="text-muted text-center"> Access and manage your billing and subscription information.</p>
                <div class="card-body">

                </div>
            </div>
                  
        </div>
    </div> 
</div> 
@endsection
