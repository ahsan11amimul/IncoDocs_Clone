@extends('pages.layouts.master')
@section('title','Inco Docs')
@section('content')
<div class="conatiner-fluid">
    <div class="row">
        <div class="col-12">
           <div style="background:blue;width:100%;height:170px;">
                <a href="{{ url('/')}}" class="text-white text-left">
                    <i class="fas fa-arrow-alt-circle-left"></i>
                    Back Home
                </a>
                <h1 class="text-center text-white pt-5">Sign in</h1>
              </div> 
        </div>
    </div>
</div>
  <div class="container">
     
    <div class="row justify-content-center m-auto">
     
       
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-body">
                     @if (Session::has('error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{Session('error')}}!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>  
                  @endif
                  @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{Session('success')}}!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>  
                  @endif
                <form method="POST" action="{{route('login')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                     <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Continue
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                  <div class="card-footer col-md-8 offset-md-3">
                <button class="btn btn-outline-success btn-block"><a href="{{url('/forgetpassword')}}" class="nav-link">Forgot Password ?? Click Here</a></button>   
                <button class="btn btn-outline-secondary btn-block"><a href="{{url('/register')}}" class="nav-link">Do not have an account ?? Get Started now</a></button>   
                </div>
               
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection
