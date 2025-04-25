<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TaskFlow') }}</title>

    <!-- Prevent Flash of Unstyled Content in Dark Mode -->
    <script>
        // Immediately restore dark mode to prevent flash
        if (localStorage.getItem('theme') === 'dark' || 
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            document.documentElement.style.backgroundColor = '#0f172a';
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-background text-foreground transition-colors duration-300">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="absolute top-4 right-4">
            <button id="theme-toggle" class="p-2 rounded-full bg-card border border-border shadow-sm hover:shadow-md transition-all duration-200">
                <svg id="theme-toggle-dark-icon" class="h-5 w-5 text-muted-foreground" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="theme-toggle-light-icon" class="h-5 w-5 text-muted-foreground hidden" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <div class="flex justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-primary" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold tracking-tight">{{ config('app.name', 'TaskFlow') }}</h1>
                <p class="text-sm text-muted-foreground mt-1">
                    @yield('auth_subtitle', 'Manage your tasks and time efficiently')
                </p>
            </div>
            
            <div class="bg-card rounded-lg shadow-soft border border-border overflow-hidden">
                <div class="p-6">
                    @yield('content')
                </div>
            </div>
            
            @if(Route::has('login') && Route::has('register'))
                <div class="text-center mt-4 text-sm text-muted-foreground">
                    @yield('auth_footer')
                </div>
            @endif
        </div>
    </div>
    
    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>
    
    <style>
        /* Theme transition for all elements */
        html.transitioning {
            --transition-duration: 300ms;
        }
        
        html.transitioning body,
        html.transitioning div,
        html.transitioning header,
        html.transitioning nav,
        html.transitioning main,
        html.transitioning aside,
        html.transitioning footer {
            transition-property: background-color, border-color;
            transition-duration: var(--transition-duration);
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        html.transitioning a,
        html.transitioning button,
        html.transitioning span,
        html.transitioning p,
        html.transitioning h1,
        html.transitioning h2,
        html.transitioning h3,
        html.transitioning h4,
        html.transitioning h5,
        html.transitioning h6,
        html.transitioning svg {
            transition-property: color, fill, stroke;
            transition-duration: var(--transition-duration);
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</body>
</html> 