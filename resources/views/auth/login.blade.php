@extends('layouts.auth')

@section('content')
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <form action="{{ route('login') }}" method="POST" class="w-75 d-flex flex-column gap-3">
            @csrf
            <h1 class="text-center fs-4 fw-bold">Welcome Back!</h1>
            <div class="">
                <label for="email" class="form-label fs-5 fw-normal">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="">
                <label for="password" class="form-label fs-5 fw-normal">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <a href="" class="text-decoration-none fs-5 fw-normal">Forget password?</a>
            <button class="btn btn-primary d-block w-100 fs-5 fw-normal">Sign In</button>
            <label class="text-center fs-5 fw-normal">Not a member yet? <a href="{{ route('register') }}" class="text-decoration-none">Sign Up</a></label>
        </form>
    </div>
@endsection
