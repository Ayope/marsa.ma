@extends('layouts.app')

@section('content')
<div class="container py-5 overflow-hidden">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card AuthContainer">
                <div class="card-body">
                    <h1 class="text-center mb-5 fw-bold">{{ __('Login') }}</h1>
                    <form method="POST" action="{{ route('login.user') }}">
                        @csrf

                        @if(Session::has('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif

                        @if(Session::has('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('register'))
                                    <a class="btn btn-link text-dark text-decoration-none" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-dark" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
