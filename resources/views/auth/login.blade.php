@extends('layouts.app')

@section('title', 'Login')

@section('breadcrumb_title', 'Login')

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mx-auto" style="max-width: 380px;">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Sign in</h4>
                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input 
                                    name="email" 
                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                    placeholder="Email" 
                                    type="email" 
                                    value="{{ old('email') }}" 
                                    required
                                >
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input 
                                    name="password" 
                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                                    placeholder="Password" 
                                    type="password" 
                                    required
                                >
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="float-left custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input">
                                    <span class="custom-control-label"> Remember </span>
                                </label>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"> Login </button>
                            </div>
                        </form>
                    </div>
                </div>

                <p class="text-center mt-4">
                    Don't have an account? <a href="{{ route('register') }}">Sign up</a>
                </p>
            </div>
        </div>
    </div>
</section>

@endsection
