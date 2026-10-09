<a href="{{ route('movies.show', $movie['id']) }}" class="block group">
    <div class="overflow-hidden rounded-sm">
        <img src="{{ $movie['poster_path'] }}"
            alt="Spider-Man: Brand New Day" loading="lazy"
            class="poster w-full object-cover bg-surface transition-transform duration-300 group-hover:scale-[1.03]" />
    </div>
    <h3 class="mt-3 text-[13px] font-medium leading-snug group-hover:text-accent transition-colors">{{ $movie['title'] }}</h3>
    <p class="mt-1 text-[11px] text-slate-300 flex items-center gap-1"><svg class="w-2.5 h-2.5 text-accent"
            viewBox="0 0 20 20" fill="currentColor">
            <path d="m10 1.5 2.6 5.6 6 .7-4.5 4.1 1.2 6L10 15l-5.3 2.9 1.2-6L1.4 7.8l6-.7L10 1.5Z" />
        </svg> {{ $movie['vote_average'] }} <span class="text-slate-500">|</span> {{ $movie['release_date'] }}</p>
    <p class="mt-0.5 text-[10px] text-slate-400"> {{ $movie['genres'] }}</p>
</a>
