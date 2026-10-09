<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie App By Mudassar Mehdi</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="bg-app text-white font-sans antialiased min-h-screen flex flex-col overflow-x-hidde">

    <header class="relative border-b border-white/5">
        <nav class="max-w-[1200px] mx-auto px-4 h-14 flex items-center gap-4 md:gap-8">
            <a href="{{ route('home.index') }}" class="flex items-center gap-2 font-semibold text-sm shrink-0">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M4 8h16v11a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8Zm.3-4.6 3.4-.9 1 3.5-3.4.9-1-3.5Zm5.2-1.4 3.4-.9 1 3.5-3.4.9-1-3.5Zm5.2-1 3.4-.9 1 3.5-3.4.9-1-3.5Z" />
                </svg>
                MovieApp
            </a>

            <ul class="hidden md:flex items-center gap-6 text-xs text-slate-200">
                <li><a href="{{ route('movies.index') }}" class="hover:text-accent transition-colors">Movies</a></li>
                <li><a href="{{ route('tv.index') }}" class="hover:text-accent transition-colors">TV Shows</a></li>
                <li><a href="{{ route('actors.index') }}" class="hover:text-accent transition-colors">Actors</a></li>
            </ul>

            <div class="ml-auto flex items-center gap-3">

                <livewire:search-dropdown />

                <button id="menu-btn" type="button" aria-expanded="false" aria-controls="mobile-menu"
                    aria-label="Toggle menu"
                    class="md:hidden w-9 h-9 -mr-1 flex items-center justify-center rounded-full hover:bg-surface transition-colors">
                    <svg id="ic-open" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round">
                        <path d="M4 7h16M4 12h16M4 17h16" />
                    </svg>
                    <svg id="ic-close" class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round">
                        <path d="m6 6 12 12M18 6 6 18" />
                    </svg>
                </button>

                <img src="/img/avatar.png" alt="Profile" class="w-7 h-7 rounded-full object-cover shrink-0" />
            </div>


        </nav>

        <!-- mobile menu (below 768px) -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-white/5 bg-app">
            <div class="max-w-[1200px] mx-auto px-4 py-4">

                <livewire:search-dropdown />

                <ul class="mt-3 text-sm divide-y divide-white/5">
                    <li><a href="{{ route('movies.index') }}"
                            class="block py-3 hover:text-accent transition-colors">Movies</a></li>
                    <li><a href="{{ route('tv.index') }}" class="block py-3 hover:text-accent transition-colors">TV
                            Shows</a></li>
                    <li><a href="{{ route('actors.index') }}"
                            class="block py-3 hover:text-accent transition-colors">Actors</a></li>
                </ul>
            </div>
        </div>
    </header>

   

    
        @yield('content')
  

    <footer class="border border-t border-gray-800">
        <div class="max-w-[1200px] mx-auto px-4 text-sm px-4 py-6">
            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-400">
                    <span class="block sm:inline">Powered by <a href="https://www.themoviedb.org/documentation/api"
                            class="underline hover:text-gray-300">TMDb API</a></span>


                </p>

                <p class="mt-4 text-sm text-gray-400  hover:text-gray-300 sm:order-first sm:mt-0">
                    &copy; 2026 | Design & Developed with Love By Mudassar Mehdi
                </p>
            </div>
        </div>
    </footer>


    @livewireScripts


    <script>
        // ---------- mobile menu ----------
        const menuBtn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');
        menuBtn.addEventListener('click', () => {
            const open = menu.classList.toggle('hidden') === false;
            menuBtn.setAttribute('aria-expanded', String(open));
            document.getElementById('ic-open').classList.toggle('hidden', open);
            document.getElementById('ic-close').classList.toggle('hidden', !open);
        });

        // ---------- search: "/" focuses, Enter searches ----------
        const inputs = [...document.querySelectorAll('input[type="search"]')];
        document.addEventListener('keydown', e => {
            if (e.key === '/' && document.activeElement.tagName !== 'INPUT') {
                e.preventDefault();
                (inputs.find(i => i.offsetParent !== null) || inputs[0]).focus();
            }
        });
        inputs.forEach(i => i.addEventListener('keydown', e => {
            if (e.key === 'Enter' && i.value.trim()) location.href = 'search.html?q=' + encodeURIComponent(i
                .value.trim());
        }));
    </script>

</body>

</html>
