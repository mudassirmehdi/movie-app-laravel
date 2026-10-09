<?php

use Illuminate\Support\Facades\Http;
use Livewire\Component;

new class extends Component {
    public string $search = '';

    public function updatedSearch(): void
    {
        // The search results are loaded through the computed property.
    }

    #[\Livewire\Attributes\Computed]
    public function searchResults()
    {
        $search = trim($this->search);

        if (strlen($search) < 2) {
            return collect();
        }

        $response = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/search/movie', [
            'query' => $search,
        ]);

        if ($response->failed()) {
            return collect();
        }

        return collect($response->json('results', []))->take(7);
    }
};
?>

<div class=" mt-3 md:mt-0" x-data="{ isOpen: true }" @click.outside="isOpen = false">
    <label class="relative hidden md:block">
        <span class="sr-only">Search</span>
        <svg class="w-3 h-3 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" viewBox="0 0 20 20" fill="none"
            stroke="currentColor" stroke-width="2">
            <circle cx="8.5" cy="8.5" r="5.5" />
            <path d="m13 13 4 4" />
        </svg>
        <input type="text" wire:model.live.debounce.500ms="search" x-ref="search" @focus="isOpen = true"
            @keydown="isOpen = true" @keydown.escape="isOpen = false" @keydown.shift.tab="isOpen = false"
            @keydown.window="
            if (event.key === '/') {
                event.preventDefault();
                $refs.search.focus();
            }
        "
            class="bg-surface text-xs placeholder-slate-400 rounded-full pl-8 pr-4 py-1.5 w-48 lg:w-64 focus:outline-none focus:ring-1 focus:ring-accent"
            placeholder="Search (Press '/' to focus)">



        {{-- Loading spinner --}}
        <div wire:loading wire:target="search" class="spinner absolute top-0 right-0 mr-4 mt-3"></div>
    </label>

    {{-- Results --}}
    @if (strlen(trim($search)) >= 2)
        <div x-show="isOpen" x-transition.opacity class="absolute z-50 mt-4 w-64 rounded bg-gray-800 text-sm">
            @if ($this->searchResults->isNotEmpty())
                <ul>
                    @foreach ($this->searchResults as $result)
                        <li class="border-b border-gray-700 last:border-b-0">
                            <a href="{{ route('movies.show', $result['id']) }}"
                                class="flex items-center px-3 py-3 transition duration-150 hover:bg-gray-700"
                                @if ($loop->last) @keydown.tab="isOpen = false" @endif>
                                @if (!empty($result['poster_path']))
                                    <img src="https://image.tmdb.org/t/p/w92{{ $result['poster_path'] }}"
                                        alt="{{ $result['title'] }}" class="h-12 w-8 object-cover">
                                @else
                                    <div class="h-12 w-8 bg-gray-700"></div>
                                @endif

                                <span class="ml-4">
                                    {{ $result['title'] }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">
                    No results for "{{ $search }}"
                </div>
            @endif
        </div>
    @endif
</div>
