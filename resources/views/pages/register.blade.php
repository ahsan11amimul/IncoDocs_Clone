@extends('pages.layouts.master')
@section('title','Inco Docs')
@section('content')
  <div class="container">
    <div class="row justify-content-center m-auto">
        <div class="col-md-8">
            <div class="card mt-5">
                 <a href="{{ url('/')}}" class="text-dark text-left">
                    <i class="fas fa-arrow-alt-circle-left"></i>
                    Back Home
                </a>
                <div class="card-header text-center">Get Started With Inco Docs</div>

                <div class="card-body">
                <form method="POST" action="{{route('register')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

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
                <div class="card-footer">
                <p class="text-center">Already have an account??&nbsp;<a href="{{url('/login')}}">Sign in</a></p>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection
