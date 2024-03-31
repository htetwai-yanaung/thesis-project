{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}

@extends('layouts.auth')

@section('content')
    <div class="w-full h-screen flex items-center justify-center">
        <form method="post" action="{{ route('login') }}" class="flex flex-col w-[420px]">
            <h1 class="text-center font-semibold text-2xl mb-5">Create Your Account!</h1>
            <div class="flex flex-col">
                <label class="font-medium text-base" for="email">Gmail</label>
                <input class="rounded border border-gray-300" type="email" name="email" :value="old('email')" id="email" placeholder="Enter your gmail">
            </div>
            <div class="flex flex-col mt-3">
                <label class="font-medium text-base" for="name">Name</label>
                <input class="rounded border border-gray-300" type="text" name="name" :value="old('name')" id="name" placeholder="Enter your name">
            </div>
            <div class="flex flex-col mt-3">
                <label class="font-medium text-base" >Attended Year</label>
                <input class="rounded border border-gray-300" type="text" name="year" :value="old('year')" placeholder="Enter your attended year">
            </div>
            <div class="flex flex-col mt-3">
                <label class="font-medium text-base" for="password">Password</label>
                <input class="rounded border border-gray-300" type="password" name="password" :value="old('name')" id="password" placeholder="Enter your password">
            </div>
            <div class="flex flex-col mt-3">
                <label class="font-medium text-base" for="password_confirmation">Confirm Password</label>
                <input class="rounded border border-gray-300" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password">
            </div>
            <button class="font-bold text-white bg-blue-800 border rounded p-2 mt-5">Sign Up</button>
            <label class="font-normal text-center">Does you have an account? <a href="{{ route('login') }}" class="text-blue-800">Sign In</a></label>
        </form>
    </div>
@endsection
