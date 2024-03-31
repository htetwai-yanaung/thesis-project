@extends('layouts.auth')

@section('content')
    <div class="w-full h-screen flex items-center justify-center">
        <form method="post" action="{{ route('login') }}" class="flex flex-col w-[420px]">
            <h1 class="text-center font-semibold text-2xl mb-5">Welcome Back!</h1>
            <div class="flex flex-col">
                <label class="font-medium text-base" for="email">Gmail</label>
                <input class="rounded border border-gray-300" type="email" name="email" id="email" placeholder="Enter your gmail">
            </div>
            <div class="flex flex-col mt-3">
                <label class="font-medium text-base" for="password">Password</label>
                <input class="rounded border border-gray-300" type="password" name="password" id="password" placeholder="Enter your password">
            </div>
            <a href="" class="text-blue-800 font-normal mb-5 mt-3">Forget password?</a>
            <button class="font-bold text-white bg-blue-800 border rounded p-2">Sign In</button>
            <label class="font-normal text-center">Not a member yet? <a href="{{ route('register') }}" class="text-blue-800">Sign Up</a></label>
        </form>
    </div>
@endsection
