@extends('layouts.main')



@section('content')
    <x-hero-section :hero-slides="$heroSlides" />

    <main class="max-w-[1200px] mx-auto px-4 w-full flex-1 py-8 sm:py-8 sm:py-12 space-y-12 sm:space-y-16">

        <section aria-labelledby="h-movies">
            <div class="flex items-baseline justify-between mb-6">
                <h2 id="h-movies" class="text-accent uppercase text-sm font-medium tracking-wide">Popular Movies</h2>
                <a href="{{ route('movies.index') }}" class="text-xs text-slate-400 hover:text-accent">View all</a>
            </div>
            <div
                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-4 sm:gap-x-6 gap-y-8 sm:gap-y-10">

                @foreach ($popularMovies as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach

            </div>
        </section>

        <section aria-labelledby="h-tv">
            <div class="flex items-baseline justify-between mb-6">
                <h2 id="h-tv" class="text-accent uppercase text-sm font-medium tracking-wide">Popular TV Shows</h2>
                <a href="{{ route('tv.index') }}" class="text-xs text-slate-400 hover:text-accent">View all</a>
            </div>
            <div
                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-4 sm:gap-x-6 gap-y-8 sm:gap-y-10">

                @foreach ($popularTv as $tvshow)
                    <x-tv-card :tvshow="$tvshow" />
                @endforeach
            </div>
        </section>

        <section aria-labelledby="h-genres">
            <div class="flex items-baseline justify-between mb-6">
                <h2 id="h-genres" class="text-accent uppercase text-sm font-medium tracking-wide">Browse by Genre</h2>

            </div>
            <div class="flex flex-wrap">
                @foreach ($genres as $genre)
                    <div class="px-4 m-2 p-2 d-inline rounded-full bg-surface text-xs text-slate-200 hover:bg-accent hover:text-white transition-colors">
                        <a href="#" class="">{{ $genre }}</a>
                    </div>
                @endforeach

            </div>


        </section>

        <section aria-labelledby="h-actors">
            <div class="flex items-baseline justify-between mb-6">
                <h2 id="h-actors" class="text-accent uppercase text-sm font-medium tracking-wide">Popular Actors</h2>
                <a href="actors.html" class="text-xs text-slate-400 hover:text-accent">View all</a>
            </div>
            <div
                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-4 sm:gap-x-6 gap-y-8 sm:gap-y-10">


                @foreach ($popularActors as $actor)
                    <a href="{{ route('actors.show', $actor['id']) }}" class="block group text-center">
                        <div
                            class="mx-auto w-28 h-28 sm:w-32 sm:h-32 rounded-full overflow-hidden ring-2 ring-transparent group-hover:ring-accent transition">
                            <img src="{{ $actor['profile_path'] }}" alt="Actor Name One" loading="lazy"
                                class="w-full h-full object-cover bg-surface" />
                        </div>
                        <h3 class="mt-3 text-[13px] font-medium group-hover:text-accent transition-colors">
                            {{ $actor['name'] }}</h3>
                        <p class="text-[10px] text-slate-400">{{ $actor['known_for'] }}</p>
                    </a>
                @endforeach
            </div>
        </section>



        {{-- <section aria-labelledby="h-products">
        <div class="flex items-baseline justify-between mb-6">
            <h2 id="h-products" class="text-accent uppercase text-sm font-medium tracking-wide">Products</h2>
            <a href="products.html" class="text-xs text-slate-400 hover:text-accent">View all</a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-4 sm:gap-x-6 gap-y-8 sm:gap-y-10">
            <a href="product.html?id=31" class="block group">
                <div class="overflow-hidden rounded-sm">
                    <img src="data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22600%22 viewBox=%220 0 400 600%22%3E%3Cdefs%3E%3ClinearGradient id=%22g%22 x1=%220%22 y1=%220%22 x2=%221%22 y2=%221%22%3E%3Cstop offset=%220%22 stop-color=%22hsl%2817,50%25,34%25%29%22/%3E%3Cstop offset=%221%22 stop-color=%22hsl%2877,55%25,10%25%29%22/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width=%22400%22 height=%22600%22 fill=%22url%28%23g%29%22/%3E%3Ccircle cx=%22300%22 cy=%22150%22 r=%22120%22 fill=%22%23fff%22 fill-opacity=%22.06%22/%3E%3Ccircle cx=%2290%22 cy=%22260%22 r=%2270%22 fill=%22%23f97316%22 fill-opacity=%22.12%22/%3E%3Ctext x=%2224%22 y=%22452%22 font-family=%22Arial,sans-serif%22 font-size=%2228%22 font-weight=%22700%22 fill=%22%23fff%22 fill-opacity=%22.92%22%3EClassic Movie%3C/text%3E%3Ctext x=%2224%22 y=%22488%22 font-family=%22Arial,sans-serif%22 font-size=%2228%22 font-weight=%22700%22 fill=%22%23fff%22 fill-opacity=%22.92%22%3EPoster%3C/text%3E%3C/svg%3E"
                        alt="Classic Movie Poster" loading="lazy"
                        class="poster w-full object-cover bg-surface transition-transform duration-300 group-hover:scale-[1.03]" />
                </div>
                <h3 class="mt-3 text-[13px] font-medium leading-snug group-hover:text-accent transition-colors">Classic
                    Movie Poster</h3>
                <p class="mt-1 text-[11px] text-slate-300"><span class="text-accent font-medium">$14.99</span> <span
                        class="text-slate-500">|</span> Poster</p>
            </a>
            <a href="product.html?id=32" class="block group">
                <div class="overflow-hidden rounded-sm">
                    <img src="data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22600%22 viewBox=%220 0 400 600%22%3E%3Cdefs%3E%3ClinearGradient id=%22g%22 x1=%220%22 y1=%220%22 x2=%221%22 y2=%221%22%3E%3Cstop offset=%220%22 stop-color=%22hsl%2864,50%25,34%25%29%22/%3E%3Cstop offset=%221%22 stop-color=%22hsl%28124,55%25,10%25%29%22/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width=%22400%22 height=%22600%22 fill=%22url%28%23g%29%22/%3E%3Ccircle cx=%22300%22 cy=%22150%22 r=%22120%22 fill=%22%23fff%22 fill-opacity=%22.06%22/%3E%3Ccircle cx=%2290%22 cy=%22260%22 r=%2270%22 fill=%22%23f97316%22 fill-opacity=%22.12%22/%3E%3Ctext x=%2224%22 y=%22470%22 font-family=%22Arial,sans-serif%22 font-size=%2228%22 font-weight=%22700%22 fill=%22%23fff%22 fill-opacity=%22.92%22%3ECinema Hoodie%3C/text%3E%3C/svg%3E"
                        alt="Cinema Hoodie" loading="lazy"
                        class="poster w-full object-cover bg-surface transition-transform duration-300 group-hover:scale-[1.03]" />
                </div>
                <h3 class="mt-3 text-[13px] font-medium leading-snug group-hover:text-accent transition-colors">Cinema
                    Hoodie</h3>
                <p class="mt-1 text-[11px] text-slate-300"><span class="text-accent font-medium">$39.00</span> <span
                        class="text-slate-500">|</span> Apparel</p>
            </a>
            <a href="product.html?id=33" class="block group">
                <div class="overflow-hidden rounded-sm">
                    <img src="data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22600%22 viewBox=%220 0 400 600%22%3E%3Cdefs%3E%3ClinearGradient id=%22g%22 x1=%220%22 y1=%220%22 x2=%221%22 y2=%221%22%3E%3Cstop offset=%220%22 stop-color=%22hsl%28111,50%25,34%25%29%22/%3E%3Cstop offset=%221%22 stop-color=%22hsl%28171,55%25,10%25%29%22/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width=%22400%22 height=%22600%22 fill=%22url%28%23g%29%22/%3E%3Ccircle cx=%22300%22 cy=%22150%22 r=%22120%22 fill=%22%23fff%22 fill-opacity=%22.06%22/%3E%3Ccircle cx=%2290%22 cy=%22260%22 r=%2270%22 fill=%22%23f97316%22 fill-opacity=%22.12%22/%3E%3Ctext x=%2224%22 y=%22470%22 font-family=%22Arial,sans-serif%22 font-size=%2228%22 font-weight=%22700%22 fill=%22%23fff%22 fill-opacity=%22.92%22%3ECollector Mug%3C/text%3E%3C/svg%3E"
                        alt="Collector Mug" loading="lazy"
                        class="poster w-full object-cover bg-surface transition-transform duration-300 group-hover:scale-[1.03]" />
                </div>
                <h3 class="mt-3 text-[13px] font-medium leading-snug group-hover:text-accent transition-colors">Collector
                    Mug</h3>
                <p class="mt-1 text-[11px] text-slate-300"><span class="text-accent font-medium">$12.50</span> <span
                        class="text-slate-500">|</span> Home</p>
            </a>
            <a href="product.html?id=34" class="block group">
                <div class="overflow-hidden rounded-sm">
                    <img src="data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22600%22 viewBox=%220 0 400 600%22%3E%3Cdefs%3E%3ClinearGradient id=%22g%22 x1=%220%22 y1=%220%22 x2=%221%22 y2=%221%22%3E%3Cstop offset=%220%22 stop-color=%22hsl%28158,50%25,34%25%29%22/%3E%3Cstop offset=%221%22 stop-color=%22hsl%28218,55%25,10%25%29%22/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width=%22400%22 height=%22600%22 fill=%22url%28%23g%29%22/%3E%3Ccircle cx=%22300%22 cy=%22150%22 r=%22120%22 fill=%22%23fff%22 fill-opacity=%22.06%22/%3E%3Ccircle cx=%2290%22 cy=%22260%22 r=%2270%22 fill=%22%23f97316%22 fill-opacity=%22.12%22/%3E%3Ctext x=%2224%22 y=%22452%22 font-family=%22Arial,sans-serif%22 font-size=%2228%22 font-weight=%22700%22 fill=%22%23fff%22 fill-opacity=%22.92%22%3EDirector%E2%80%99s%3C/text%3E%3Ctext x=%2224%22 y=%22488%22 font-family=%22Arial,sans-serif%22 font-size=%2228%22 font-weight=%22700%22 fill=%22%23fff%22 fill-opacity=%22.92%22%3EClapperboard%3C/text%3E%3C/svg%3E"
                        alt="Director’s Clapperboard" loading="lazy"
                        class="poster w-full object-cover bg-surface transition-transform duration-300 group-hover:scale-[1.03]" />
                </div>
                <h3 class="mt-3 text-[13px] font-medium leading-snug group-hover:text-accent transition-colors">Director’s
                    Clapperboard</h3>
                <p class="mt-1 text-[11px] text-slate-300"><span class="text-accent font-medium">$24.00</span> <span
                        class="text-slate-500">|</span> Collectible</p>
            </a>
            <a href="product.html?id=35" class="block group">
                <div class="overflow-hidden rounded-sm">
                    <img src="data:image/svg+xml;utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22600%22 viewBox=%220 0 400 600%22%3E%3Cdefs%3E%3ClinearGradient id=%22g%22 x1=%220%22 y1=%220%22 x2=%221%22 y2=%221%22%3E%3Cstop offset=%220%22 stop-color=%22hsl%28205,50%25,34%25%29%22/%3E%3Cstop offset=%221%22 stop-color=%22hsl%28265,55%25,10%25%29%22/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width=%22400%22 height=%22600%22 fill=%22url%28%23g%29%22/%3E%3Ccircle cx=%22300%22 cy=%22150%22 r=%22120%22 fill=%22%23fff%22 fill-opacity=%22.06%22/%3E%3Ccircle cx=%2290%22 cy=%22260%22 r=%2270%22 fill=%22%23f97316%22 fill-opacity=%22.12%22/%3E%3Ctext x=%2224%22 y=%22452%22 font-family=%22Arial,sans-serif%22 font-size=%2228%22 font-weight=%22700%22 fill=%22%23fff%22 fill-opacity=%22.92%22%3EPopcorn Gift%3C/text%3E%3Ctext x=%2224%22 y=%22488%22 font-family=%22Arial,sans-serif%22 font-size=%2228%22 font-weight=%22700%22 fill=%22%23fff%22 fill-opacity=%22.92%22%3EBox%3C/text%3E%3C/svg%3E"
                        alt="Popcorn Gift Box" loading="lazy"
                        class="poster w-full object-cover bg-surface transition-transform duration-300 group-hover:scale-[1.03]" />
                </div>
                <h3 class="mt-3 text-[13px] font-medium leading-snug group-hover:text-accent transition-colors">Popcorn
                    Gift Box</h3>
                <p class="mt-1 text-[11px] text-slate-300"><span class="text-accent font-medium">$18.75</span> <span
                        class="text-slate-500">|</span> Gift</p>
            </a>
        </div>
    </section> --}}

    </main>
@endsection


@section('scripts')
@endsection
