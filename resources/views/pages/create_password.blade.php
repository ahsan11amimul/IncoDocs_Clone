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
                <h1 class="text-center text-white pt-5">Create New Password</h1>
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
                <form method="POST" action="{{url('createpassword/'.$user->id)}}">
                        @csrf
                        

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
                        <div class="form-group row">
                            <label for="confirm_password" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="confirm_password" type="password" class="form-control @error('condirm_password') is-invalid @enderror" name="confirm_password" required autocomplete="new-password">

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
                
            </div>
        </div>
    </div>
</div>  
@endsection
