@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg" style="max-width: 400px; width: 100%;">
        <div class="card-header text-center">
            <h4>Login to Your Account</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
        <div class="card-footer text-center">
            <a href="{{ route('password.request') }}">Forgot Your Password?</a><br>
            <a href="{{ route('register') }}">Create an Account</a>
        </div>
    </div>
</div>
@endsection
