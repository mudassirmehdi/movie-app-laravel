@php
    $slides = collect($heroSlides)->values();
    $totalSlides = $slides->count();
@endphp

<section id="hero" aria-roledescription="carousel" aria-label="Featured shows"
    class="relative w-full overflow-hidden grid bg-app">

    @foreach ($slides as $index => $slide)
        @php
            $previousIndex = ($index - 1 + $totalSlides) % $totalSlides;
            $nextIndex = ($index + 1) % $totalSlides;

            $previous = $slides[$previousIndex];
            $next = $slides[$nextIndex];
        @endphp

        <article data-slide aria-roledescription="slide"
            aria-label="Slide {{ $index + 1 }} of {{ $totalSlides }}: {{ $slide['title'] }}"
            aria-hidden="{{ $index === 0 ? 'false' : 'true' }}" @if ($index !== 0) inert @endif
            class="col-start-1 row-start-1 relative flex flex-col h-[760px] min-h-0 sm:h-[700px] sm:min-h-0 transition-opacity duration-700 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 pointer-events-none' }}"
            style="background-image: url('{{ $slide['backdrop_path'] ?? '' }}'); background-position: center; background-size: cover; background-repeat: no-repeat;">

            <div class="absolute inset-0 bg-gradient-to-r from-app/95 via-app/50 to-app/10"></div>
            <div class="absolute inset-x-0 bottom-0 h-48 bg-gradient-to-t from-app/90 to-transparent"></div>

            <div class="relative flex-1 flex items-center">
                <div class="max-w-[1200px] mx-auto px-4 w-full py-16 flex items-center gap-8">

                    <div
                        class="hidden sm:flex flex-col items-center gap-3 text-[11px] uppercase tracking-wider text-white/80">
                        <span class="[writing-mode:vertical-rl] rotate-180">
                            {{ $slide['release_date'] }}
                        </span>

                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 7v5l3 2" />
                        </svg>
                    </div>

                    <div class="">
                        <p class="sm:hidden mb-3 text-[11px] uppercase tracking-wider text-white/80">
                            {{ $slide['release_date'] }}
                        </p>

                        <h1 class="text-4xl sm:text-6xl font-medium leading-[1.05] tracking-tight break-words">
                            {{ $slide['title'] }}
                        </h1>

                        <p class="mt-5 text-sm sm:text-base text-slate-200 leading-relaxed">
                            {{ $slide['overview'] ?: 'Discover more about this title.' }}
                        </p>

                        <div class="mt-8 flex items-center gap-4">
                            <a href="#trailer"
                                class="text-cyan-300 font-medium underline underline-offset-4 decoration-2 text-sm hover:text-cyan-200">
                                watch trailer
                            </a>

                            <a href="#trailer" aria-label="Play trailer of {{ $slide['title'] }}"
                                class="w-10 h-10 rounded-full border-2 border-cyan-300 text-cyan-300 flex items-center justify-center hover:bg-cyan-300 hover:text-app transition-colors">
                                <svg class="w-4 h-4 ml-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linejoin="round">
                                    <path d="M7 4.5v15l12-7.5-12-7.5Z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative border-t border-white/20">
                <div class="max-w-[1200px] mx-auto px-4 grid grid-cols-2 sm:grid-cols-3 items-center">

                    {{-- Previous show: same original layout --}}
                    <button type="button" data-go="prev"
                        class="group flex items-center gap-3 sm:gap-4 py-5 sm:pr-6 text-left">
                        <span class="relative shrink-0">
                            <img src="{{ $previous['poster_path'] ?? ($previous['backdrop_path'] ?? '') }}"
                                alt="" class="w-12 h-12 sm:w-16 sm:h-16 rounded-full object-cover bg-surface" />

                            <span
                                class="absolute -right-3 top-1/2 -translate-y-1/2 w-7 h-7 rounded-full bg-accent flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-white" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                </svg>
                            </span>
                        </span>

                        <span class="ml-2 min-w-0">
                            <span
                                class="block text-base sm:text-lg font-medium group-hover:text-accent transition-colors truncate">
                                {{ $previous['title'] }}
                            </span>
                            <span class="block text-xs sm:text-sm text-slate-300">
                                {{ $previous['release_date'] }}
                            </span>
                        </span>
                    </button>

                    {{-- Original previous/next controls --}}
                    <div
                        class="hidden sm:flex flex-col gap-4 py-5 px-6 border-x border-white/20 self-stretch justify-center">
                        <button type="button" data-go="prev" aria-label="Previous slide"
                            class="flex items-center group">
                            <span
                                class="w-9 h-9 rounded-full bg-white text-app flex items-center justify-center shrink-0 group-hover:bg-accent group-hover:text-white transition-colors">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m15 6-6 6 6 6" />
                                </svg>
                            </span>
                            <span class="flex-1 relative h-px bg-white/70">
                                <span
                                    class="absolute right-0 -top-4 text-[9px] font-semibold tracking-wider">PREV</span>
                            </span>
                        </button>

                        <button type="button" data-go="next" aria-label="Next slide" class="flex items-center group">
                            <span class="flex-1 relative h-px bg-white/70">
                                <span class="absolute left-0 -top-4 text-[9px] font-semibold tracking-wider">NEXT</span>
                            </span>
                            <span
                                class="w-9 h-9 rounded-full bg-white text-app flex items-center justify-center shrink-0 group-hover:bg-accent group-hover:text-white transition-colors">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 6 6 6-6 6" />
                                </svg>
                            </span>
                        </button>
                    </div>

                    {{-- Next show: same original layout --}}
                    <button type="button" data-go="next"
                        class="group flex items-center justify-end gap-3 sm:gap-4 py-5 sm:pl-6 text-right">
                        <span class="min-w-0">
                            <span
                                class="block text-base sm:text-lg font-medium group-hover:text-accent transition-colors truncate">
                                {{ $next['title'] }}
                            </span>
                            <span class="block text-xs sm:text-sm text-slate-300">
                                {{ $next['release_date'] }}
                            </span>
                        </span>

                        <span class="relative shrink-0 mr-3">
                            <img src="{{ $next['poster_path'] ?? ($next['backdrop_path'] ?? '') }}" alt=""
                                class="w-12 h-12 sm:w-16 sm:h-16 rounded-full object-cover bg-surface" />

                            <span
                                class="absolute -left-3 top-1/2 -translate-y-1/2 w-7 h-7 rounded-full bg-accent flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-white" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M19 12H5M11 6l-6 6 6 6" />
                                </svg>
                            </span>
                        </span>
                    </button>

                </div>
            </div>
        </article>
    @endforeach

    {{-- Dynamic dots, preserving your original classes --}}
    <div class="absolute z-20 top-4 right-4 flex flex-row gap-3 sm:top-1/2 sm:right-8 sm:-translate-y-1/2 sm:flex-col">
        @foreach ($slides as $index => $slide)
            <button type="button" data-dot="{{ $index }}" aria-label="Go to slide {{ $index + 1 }}"
                aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                class="relative w-2.5 h-2.5 rounded-full before:absolute before:-inset-2.5 transition-colors {{ $index === 0 ? 'bg-accent' : 'bg-white/40' }} hover:bg-accent">
            </button>
        @endforeach
    </div>
</section>

<script>
    (() => {
        const hero = document.getElementById('hero');

        if (!hero || hero.dataset.sliderInitialized === 'true') return;

        hero.dataset.sliderInitialized = 'true';

        const slides = [...hero.querySelectorAll('[data-slide]')];
        const dots = [...hero.querySelectorAll('[data-dot]')];

        if (!slides.length) {
            console.error('Hero slider: no slides found.');
            return;
        }

        let current = 0;
        let timer;

        function showSlide(index) {
            current = (index + slides.length) % slides.length;

            slides.forEach((slide, i) => {
                const active = i === current;

                slide.classList.toggle('opacity-100', active);
                slide.classList.toggle('opacity-0', !active);
                slide.classList.toggle('z-10', active);
                slide.classList.toggle('pointer-events-none', !active);
                slide.toggleAttribute('inert', !active);
                slide.setAttribute('aria-hidden', String(!active));
            });

            dots.forEach((dot, i) => {
                const active = i === current;

                dot.classList.toggle('bg-accent', active);
                dot.classList.toggle('bg-white/40', !active);
                dot.setAttribute('aria-current', String(active));
            });
        }

        function startAutoSlide() {
            clearInterval(timer);

            if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                timer = setInterval(() => showSlide(current + 1), 5000);
            }
        }

        // Pause auto-slide when mouse enters the hero
        hero.addEventListener('mouseenter', () => {
            clearInterval(timer);
        });

        // Resume auto-slide when mouse leaves the hero
        hero.addEventListener('mouseleave', () => {
            startAutoSlide();
        });

        hero.querySelectorAll('[data-go]').forEach(button => {
            button.addEventListener('click', () => {
                if (button.dataset.go === 'next') {
                    showSlide(current + 1);
                } else if (button.dataset.go === 'prev') {
                    showSlide(current - 1);
                }

                startAutoSlide();
            });
        });

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
                startAutoSlide();
            });
        });

        showSlide(0);
        startAutoSlide();

        console.log('Hero slider ready:', slides.length, 'slides');
    })();
</script>
