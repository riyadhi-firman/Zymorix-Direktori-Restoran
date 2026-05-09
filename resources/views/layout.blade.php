<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zymorix | Direktori Restoran</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Theme Script (to avoid FOUC) -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    <!-- Tailwind & Alpinejs -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#4F46E5', // Indigo-600
                        secondary: '#10B981', // Emerald-500
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-15px)' },
                        },
                        fadeUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    },
                    animation: {
                        float: 'float 3s ease-in-out infinite',
                        fadeUp: 'fadeUp 0.6s ease-out both',
                    }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body
    class="bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 font-sans antialiased min-h-screen flex flex-col transition-colors duration-300">

    <!-- Navigation -->
    <nav class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200 dark:border-slate-800 shadow-sm transition-colors duration-300"
        x-data="{ mobileMenuOpen: false, isDark: document.documentElement.classList.contains('dark') }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="/"
                        class="flex items-center gap-2 text-primary dark:text-indigo-400 font-bold text-xl tracking-tight">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                        <span>Zymorix</span>
                    </a>
                </div>

                <div class="hidden md:flex space-x-8 items-center">
                    <a href="/"
                        class="{{ request()->is('/') ? 'text-primary dark:text-indigo-400 border-b-2 border-primary dark:border-indigo-400 font-semibold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100' }} inline-flex items-center px-1 pt-1 text-sm transition-colors duration-200">Beranda</a>
                    <a href="/restoran"
                        class="{{ request()->is('restoran*') ? 'text-primary dark:text-indigo-400 border-b-2 border-primary dark:border-indigo-400 font-semibold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100' }} inline-flex items-center px-1 pt-1 text-sm transition-colors duration-200">Restoran</a>
                    <a href="/menu"
                        class="{{ request()->is('menu*') ? 'text-primary dark:text-indigo-400 border-b-2 border-primary dark:border-indigo-400 font-semibold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100' }} inline-flex items-center px-1 pt-1 text-sm transition-colors duration-200">Menu</a>

                    <!-- Theme Toggle Desktop -->
                    <button
                        @click="isDark = !isDark; document.documentElement.classList.toggle('dark'); localStorage.theme = isDark ? 'dark' : 'light'"
                        class="text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-indigo-400 transition-colors p-2 rounded-full focus:outline-none">
                        <svg x-show="!isDark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                            </path>
                        </svg>
                        <svg x-show="isDark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Mobile Menu Button & Theme Toggle -->
                <div class="md:hidden flex items-center gap-2">
                    <button
                        @click="isDark = !isDark; document.documentElement.classList.toggle('dark'); localStorage.theme = isDark ? 'dark' : 'light'"
                        class="text-slate-500 dark:text-slate-400 hover:text-primary transition-colors p-2">
                        <svg x-show="!isDark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                            </path>
                        </svg>
                        <svg x-show="isDark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </button>
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="text-slate-500 dark:text-slate-400 focus:outline-none p-2">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display: none;"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div x-show="mobileMenuOpen"
            class="md:hidden border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 transition-colors duration-300"
            style="display: none;">
            <div class="pt-2 pb-3 space-y-1 px-4 text-center">
                <a href="/"
                    class="block py-2 {{ request()->is('/') ? 'text-primary dark:text-indigo-400 font-semibold bg-indigo-50 dark:bg-indigo-900/30 rounded-md' : 'text-slate-500 dark:text-slate-400' }}">Beranda</a>
                <a href="/restoran"
                    class="block py-2 {{ request()->is('restoran*') ? 'text-primary dark:text-indigo-400 font-semibold bg-indigo-50 dark:bg-indigo-900/30 rounded-md' : 'text-slate-500 dark:text-slate-400' }}">Restoran</a>
                <a href="/menu"
                    class="block py-2 {{ request()->is('menu*') ? 'text-primary dark:text-indigo-400 font-semibold bg-indigo-50 dark:bg-indigo-900/30 rounded-md' : 'text-slate-500 dark:text-slate-400' }}">Menu</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow w-full opacity-0 transition-opacity duration-700 ease-out" 
          x-data="{ show: false }" 
          x-init="setTimeout(() => show = true, 50)" 
          :class="{ 'opacity-100': show }">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 w-full">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer
        class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 mt-auto transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex justify-center md:justify-start space-x-6 md:order-2">
                    <span class="text-slate-400 dark:text-slate-500 text-sm">Firman
                        Riyadhi | 112522093</span>
                </div>
                <div class="mt-4 md:mt-0 md:order-1 text-center md:text-left">
                    <a href="/"
                        class="text-primary dark:text-indigo-400 font-bold text-lg tracking-tight inline-flex items-center gap-1"><svg
                            class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>Zymorix</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>