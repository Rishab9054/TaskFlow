@extends('layouts.auth')

@section('auth_subtitle', 'Sign in to your account')

@section('content')
<form method="POST" action="{{ route('login') }}" class="space-y-6">
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

    <div class="space-y-2">
        <div class="flex justify-between items-center">
            <label for="password" class="block text-sm font-medium">{{ __('Password') }}</label>
            @if (Route::has('password.request'))
                <a class="text-xs text-primary hover:text-primary/80 transition-colors" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-muted-foreground" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <input id="password" type="password" class="w-full pl-10 py-2 border border-input bg-background rounded-md focus:ring-2 focus:ring-primary/50 focus:outline-none @error('password') border-destructive @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
        </div>
        @error('password')
            <p class="text-destructive text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center">
        <input class="h-4 w-4 text-primary border-input rounded focus:ring-primary/50" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="ml-2 block text-sm text-muted-foreground" for="remember">
            {{ __('Remember Me') }}
        </label>
    </div>

    <button type="submit" class="w-full py-2.5 px-4 bg-primary text-primary-foreground rounded-md hover:bg-primary/90 transition-colors font-medium shadow-sm hover:shadow-md">
        {{ __('Sign In') }}
    </button>
</form>
@endsection

@section('auth_footer')
@if (Route::has('register'))
    {{ __("Don't have an account?") }} 
    <a href="{{ route('register') }}" class="font-medium text-primary hover:underline">
        {{ __('Register') }}
    </a>
@endif
@endsection
