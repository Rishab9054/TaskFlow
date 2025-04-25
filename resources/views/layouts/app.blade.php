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
    
    @yield('styles')
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Sidebar Navigation -->
        <div class="w-64 bg-bg-secondary border-r border-border shadow-md">
            <div class="flex flex-col h-full">
                <div class="p-5 border-b border-border flex items-center justify-between">
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold text-primary flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        TaskFlow
                    </a>
                </div>
                
                <div class="p-4 flex-1">
                    <nav class="space-y-2" x-data="{ navigating: false }">
                        <a href="{{ route('dashboard') }}" 
                           @click.prevent="navigating = true; 
                                          const isDark = document.documentElement.classList.contains('dark');
                                          if (isDark) document.documentElement.style.backgroundColor = '#0f172a';
                                          document.querySelector('main').classList.add('page-loading'); 
                                          setTimeout(() => window.location.href = $el.getAttribute('href'), 300)" 
                           class="flex items-center px-3 py-2.5 rounded-md nav-link {{ request()->routeIs('dashboard') ? 'active bg-bg-hover text-primary' : 'text-text-secondary hover:bg-bg-hover hover:text-primary' }} transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            Dashboard
                        </a>
                        
                        <a href="{{ route('calendar') }}" 
                           @click.prevent="navigating = true; 
                                          const isDark = document.documentElement.classList.contains('dark');
                                          if (isDark) document.documentElement.style.backgroundColor = '#0f172a';
                                          document.querySelector('main').classList.add('page-loading'); 
                                          setTimeout(() => window.location.href = $el.getAttribute('href'), 300)" 
                           class="flex items-center px-3 py-2.5 rounded-md nav-link {{ request()->routeIs('calendar') ? 'active bg-bg-hover text-primary' : 'text-text-secondary hover:bg-bg-hover hover:text-primary' }} transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            Calendar
                        </a>
                        
                        <a href="{{ route('settings') }}" 
                           @click.prevent="navigating = true; 
                                          const isDark = document.documentElement.classList.contains('dark');
                                          if (isDark) document.documentElement.style.backgroundColor = '#0f172a';
                                          document.querySelector('main').classList.add('page-loading'); 
                                          setTimeout(() => window.location.href = $el.getAttribute('href'), 300)" 
                           class="flex items-center px-3 py-2.5 rounded-md nav-link {{ request()->routeIs('settings') ? 'active bg-bg-hover text-primary' : 'text-text-secondary hover:bg-bg-hover hover:text-primary' }} transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                            </svg>
                            Settings
                        </a>
                    </nav>
                </div>
                
                <div class="p-4 border-t border-border space-y-4">
                    <!-- Theme Toggle Button -->
                    <button id="theme-toggle" class="w-full flex items-center justify-between px-3 py-2.5 rounded-md text-text-secondary hover:bg-bg-hover hover:text-primary transition-all duration-200" aria-label="Toggle theme">
                        <div class="flex items-center">
                            <svg id="theme-toggle-dark-icon" class="h-5 w-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="h-5 w-5 mr-3 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                            <span id="theme-toggle-text">Dark Mode</span>
                        </div>
                        <div class="relative">
                            <div class="w-10 h-5 bg-muted rounded-full"></div>
                            <div class="absolute top-0.5 left-0.5 dark:left-5 w-4 h-4 bg-primary rounded-full transition-all duration-300"></div>
                        </div>
                    </button>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-3 py-2.5 rounded-md text-foreground hover:bg-bg-hover hover:text-primary transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 mr-3">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            Log out
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1">
            <header class="bg-card border-b border-border p-5 shadow-sm sticky top-0 z-10">
                <div class="flex justify-between items-center">
                    <h1 class="text-xl font-bold text-foreground tracking-tight">
                        @yield('header_title', 'Dashboard')
                    </h1>
                    <div class="flex items-center space-x-4">
                        <!-- User Profile Area -->
                        <div class="flex items-center">
                            <div class="w-10 h-10 flex items-center justify-center bg-primary text-white rounded-full">
                                <span class="text-sm font-medium">{{ substr(Auth::user()->name ?? 'U', 0, 1) }}</span>
                            </div>
                        </div>
                        
                        <!-- Quick actions -->
                        <button class="p-2 hover:bg-muted transition-colors duration-200" aria-label="Notifications">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </header>
            <main x-data="{ pageLoaded: false }" 
                  x-init="setTimeout(() => pageLoaded = true, 100)" 
                  :class="{ 'page-loading': !pageLoaded, 'page-loaded': pageLoaded }"
                  class="p-6 lg:p-8 overflow-auto max-h-[calc(100vh-4rem)]">
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>
    
    <!-- Modal Container -->
    <div id="modal-container" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="modal-backdrop fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm transition-opacity duration-300"></div>
        <div class="modal-content bg-card w-full max-w-md p-6 rounded-lg shadow-xl border border-border relative z-10 transform scale-95 opacity-0 transition-all duration-300">
            <!-- Modal content will be dynamically loaded here -->
        </div>
    </div>
    
    <style>
        /* Theme transition for all elements - ONLY apply when theme changes */
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
        
        /* Page transition animations */
        .page-transition-enter {
            opacity: 0;
            transform: translateY(10px);
        }
        
        .page-transition-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 300ms, transform 300ms;
        }
        
        .page-transition-exit {
            opacity: 1;
        }
        
        .page-transition-exit-active {
            opacity: 0;
            transition: opacity 300ms;
        }
        
        /* Page loading animation */
        main {
            transition: opacity 300ms ease-in-out, transform 300ms ease-in-out;
        }
        
        main.page-loading {
            opacity: 0;
            transform: translateY(10px);
        }
        
        main.page-loaded {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Modal animations */
        .modal-appear {
            animation: modalAppear 0.3s ease forwards;
        }
        
        .modal-disappear {
            animation: modalDisappear 0.3s ease forwards;
        }
        
        @keyframes modalAppear {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        @keyframes modalDisappear {
            from {
                opacity: 1;
                transform: scale(1);
            }
            to {
                opacity: 0;
                transform: scale(0.95);
            }
        }
        
        /* Improved navigation link styles */
        .nav-link.active {
            font-weight: 500;
            position: relative;
        }
        
        .nav-link.active:before {
            content: '';
            position: absolute;
            left: 0;
            top: 8px;
            bottom: 8px;
            width: 3px;
            background: currentColor;
            border-radius: 0 2px 2px 0;
        }
        
        /* Typography improvements */
        h1, h2, h3, h4, h5, h6 {
            letter-spacing: -0.025em;
            line-height: 1.25;
        }
        
        p, li {
            line-height: 1.6;
            letter-spacing: 0.01em;
        }
    </style>
    
    @stack('scripts')
</body>
</html>
