@extends('layouts.auth')

@section('auth_subtitle', 'Reset your password')

@section('content')
    @if (session('status'))
        <div class="bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 p-4 rounded-md mb-6">
            <p class="text-green-800 dark:text-green-200 text-sm">{{ session('status') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <div class="space-y-2">
            <label for="email" class="block text-sm font-medium">{{ __('Email Address') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-muted-foreground" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </div>
                <input id="email" type="email" class="w-full pl-10 py-2 border border-input bg-background rounded-md focus:ring-2 focus:ring-primary/50 focus:outline-none @error('email') border-destructive @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="you@example.com">
            </div>
            @error('email')
                <p class="text-destructive text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full py-2.5 px-4 bg-primary text-primary-foreground rounded-md hover:bg-primary/90 transition-colors font-medium shadow-sm hover:shadow-md">
            {{ __('Send Password Reset Link') }}
        </button>
    </form>
@endsection

@section('auth_footer')
    <a href="{{ route('login') }}" class="font-medium text-primary hover:underline">
        {{ __('Back to Login') }}
    </a>
@endsection
