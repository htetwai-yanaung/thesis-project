@extends('layouts.auth')

@section('content')
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <form method="POST" action="{{ route('register') }}" class="w-75 d-flex flex-column gap-3">
            @csrf
            <h1 class="text-center fs-4 fw-bold">Create Your Account!</h1>
            <div class="">
                <label class="form-label fs-5 fw-normal" for="name">Name</label>
                <input class="form-control" type="text" name="name" value="{{ old('name') }}" id="name" placeholder="Enter your name">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="">
                <label class="form-label fs-5 fw-normal" for="email">Email</label>
                <input class="form-control" type="email" name="email" value="{{ old('email') }}" id="email" placeholder="Enter your email">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="">
                <label class="form-label fs-5 fw-normal" >Attended Year</label>
                <select class="form-control" name="year" id="">
                    <option value="">Select attended year</option>
                    @for ($i = 1; $i <= 6; $i++)
                        <option value="{{ $i }}" @if($i == old('year')) selected @endif >{{ $i }} Year</option>
                    @endfor
                    {{-- <option value="2">2nd Year</option>
                    <option value="3">3rd Year</option>
                    <option value="4">4th Year</option>
                    <option value="5">5th Year</option>
                    <option value="6">6th Year</option> --}}
                </select>
                @error('year')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="">
                <label class="form-label fs-5 fw-normal" for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="Enter your password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="">
                <label class="form-label fs-5 fw-normal" for="password_confirmation">Confirm Password</label>
                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password">
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-primary">Sign Up</button>
            <label class="fs-5 fw-normal text-center">Does you have an account? <a href="{{ route('login') }}" class="text-blue-800">Sign In</a></label>
        </form>
    </div>
@endsection
