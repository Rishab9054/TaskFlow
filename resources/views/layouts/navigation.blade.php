<nav class="border-b border-border bg-card">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold text-primary">
                        TaskFlow
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:ml-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'border-primary text-primary' : 'border-transparent text-muted-foreground hover:text-foreground hover:border-border' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Dashboard
                    </a>
                    <a href="{{ route('calendar') }}" class="{{ request()->routeIs('calendar') ? 'border-primary text-primary' : 'border-transparent text-muted-foreground hover:text-foreground hover:border-border' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Calendar
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Theme Toggle Button -->
                <button id="theme-toggle" class="p-2 mr-4 rounded-full bg-muted flex items-center justify-center hover:bg-accent/10 transition-colors duration-200">
                    <svg id="theme-toggle-dark-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
                
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center text-sm font-medium text-muted-foreground hover:text-foreground focus:outline-none transition duration-150 ease-in-out">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>

                    <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-popover border border-border ring-1 ring-black ring-opacity-5">
                        <div class="py-1">
                            <a href="{{ route('settings') }}" class="block px-4 py-2 text-sm text-foreground hover:bg-muted">
                                Settings
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-foreground hover:bg-muted">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <!-- Mobile Theme Toggle -->
                <button id="mobile-theme-toggle" class="p-2 mr-2 rounded-full bg-muted flex items-center justify-center hover:bg-accent/10 transition-colors duration-200">
                    <svg id="mobile-theme-toggle-dark-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="mobile-theme-toggle-light-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
                
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-muted-foreground hover:text-foreground hover:bg-muted focus:outline-none focus:bg-muted transition duration-150 ease-in-out" x-data="{ open: false }">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden" x-data="{ open: false }">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" 
               @click.prevent="const isDark = document.documentElement.classList.contains('dark');
                               if (isDark) document.documentElement.style.backgroundColor = '#0f172a';
                               document.querySelector('main').classList.add('page-loading'); 
                               setTimeout(() => window.location.href = $el.getAttribute('href'), 300)"
               class="{{ request()->routeIs('dashboard') ? 'bg-primary/10 border-primary text-primary' : 'border-transparent text-muted-foreground hover:text-foreground hover:bg-muted hover:border-border' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                Dashboard
            </a>
            <a href="{{ route('calendar') }}" 
               @click.prevent="const isDark = document.documentElement.classList.contains('dark');
                               if (isDark) document.documentElement.style.backgroundColor = '#0f172a';
                               document.querySelector('main').classList.add('page-loading'); 
                               setTimeout(() => window.location.href = $el.getAttribute('href'), 300)"
               class="{{ request()->routeIs('calendar') ? 'bg-primary/10 border-primary text-primary' : 'border-transparent text-muted-foreground hover:text-foreground hover:bg-muted hover:border-border' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                Calendar
            </a>
        </div>

        <div class="pt-4 pb-1 border-t border-border">
            <div class="px-4">
                <div class="font-medium text-base text-foreground">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-muted-foreground">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('settings') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-muted-foreground hover:text-foreground hover:bg-muted hover:border-border">
                    Settings
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-muted-foreground hover:text-foreground hover:bg-muted hover:border-border">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>