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
                <h3 class="card-header text-center">Company Settings</h3>
                <p class="text-muted text-center"> Your company information, name and business information settings.</p>

                <div class="card-body">
                     @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{Session('success')}}!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>  
                  @endif
                <form method="POST" action="{{route('company')}}">
                        @csrf
                        

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('COMPANY NAME') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $company->name??'' }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="registration_number" class="col-md-4 col-form-label text-md-right">{{ __('REGISTRATION NUMBER') }}</label>

                            <div class="col-md-6">
                                <input id="registration_number" type="registration_number" class="form-control @error('registration_number') is-invalid @enderror" name="registration_number" value="{{ $company->registration_number??'' }}" required autocomplete="registration_number">

                                @error('registration_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                      

                     <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Update
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
