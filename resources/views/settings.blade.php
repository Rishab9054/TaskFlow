@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Settings</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-3">
            @if (session('status') === 'profile-updated')
                <div class="mb-4 p-4 bg-green-500/10 border border-green-500 rounded-md text-green-500">
                    Your profile information has been updated.
                </div>
            @endif
            
            @if (session('status') === 'password-updated')
                <div class="mb-4 p-4 bg-green-500/10 border border-green-500 rounded-md text-green-500">
                    Your password has been updated.
                </div>
            @endif
        </div>
        
        <div class="md:col-span-2 space-y-6">
            <!-- Profile Information -->
            <div class="bg-card border border-border rounded-lg shadow-sm">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-4">Profile Information</h2>
                    <form method="POST" action="{{ route('settings.profile') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium mb-1">Name</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" 
                                class="w-full px-3 py-2 border border-border rounded-md bg-background"
                                required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium mb-1">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" 
                                class="w-full px-3 py-2 border border-border rounded-md bg-background"
                                required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <button type="submit" class="px-4 py-2 bg-primary text-primary-foreground rounded-md hover:bg-primary/90">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Update Password -->
            <div class="bg-card border border-border rounded-lg shadow-sm">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-4">Update Password</h2>
                    <form method="POST" action="{{ route('settings.password') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="current_password" class="block text-sm font-medium mb-1">Current Password</label>
                            <input id="current_password" name="current_password" type="password" 
                                class="w-full px-3 py-2 border border-border rounded-md bg-background"
                                required>
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium mb-1">New Password</label>
                            <input id="password" name="password" type="password" 
                                class="w-full px-3 py-2 border border-border rounded-md bg-background"
                                required>
                            @error('password')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium mb-1">Confirm Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" 
                                class="w-full px-3 py-2 border border-border rounded-md bg-background"
                                required>
                        </div>
                        
                        <button type="submit" class="px-4 py-2 bg-primary text-primary-foreground rounded-md hover:bg-primary/90">
                            Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="md:col-span-1">
            <div class="bg-card border border-border rounded-lg shadow-sm">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-4">Your Account</h2>
                    <div class="mb-4">
                        <p class="text-sm text-muted-foreground">
                            Manage your account settings and preferences
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 