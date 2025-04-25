@extends('layouts.auth')

@section('auth_subtitle', 'Create a new account')

@section('content')
<form method="POST" action="{{ route('register') }}" class="space-y-6">
    @csrf

    <div class="space-y-2">
        <label for="name" class="block text-sm font-medium">{{ __('Name') }}</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-muted-foreground" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                </svg>
            </div>
            <input id="name" type="text" class="w-full pl-10 py-2 border border-input bg-background rounded-md focus:ring-2 focus:ring-primary/50 focus:outline-none @error('name') border-destructive @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Your name">
        </div>
        @error('name')
            <p class="text-destructive text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="space-y-2">
        <label for="email" class="block text-sm font-medium">{{ __('Email Address') }}</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-muted-foreground" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                </svg>
            </div>
            <input id="email" type="email" class="w-full pl-10 py-2 border border-input bg-background rounded-md focus:ring-2 focus:ring-primary/50 focus:outline-none @error('email') border-destructive @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="you@example.com">
        </div>
        @error('email')
            <p class="text-destructive text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="space-y-2">
        <label for="password" class="block text-sm font-medium">{{ __('Password') }}</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-muted-foreground" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <input id="password" type="password" class="w-full pl-10 py-2 border border-input bg-background rounded-md focus:ring-2 focus:ring-primary/50 focus:outline-none @error('password') border-destructive @enderror" name="password" required autocomplete="new-password" placeholder="••••••••">
        </div>
        @error('password')
            <p class="text-destructive text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="space-y-2">
        <label for="password-confirm" class="block text-sm font-medium">{{ __('Confirm Password') }}</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-muted-foreground" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <input id="password-confirm" type="password" class="w-full pl-10 py-2 border border-input bg-background rounded-md focus:ring-2 focus:ring-primary/50 focus:outline-none" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
        </div>
    </div>

    <button type="submit" class="w-full py-2.5 px-4 bg-primary text-primary-foreground rounded-md hover:bg-primary/90 transition-colors font-medium shadow-sm hover:shadow-md">
        {{ __('Register') }}
    </button>
</form>
@endsection

@section('auth_footer')
{{ __('Already have an account?') }} 
<a href="{{ route('login') }}" class="font-medium text-primary hover:underline">
    {{ __('Sign In') }}
</a>
@endsection
