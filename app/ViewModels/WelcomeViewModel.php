<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class WelcomeViewModel extends ViewModel
{

    public $popularMovies;
    public $popularTv;
    public $genres;
    public $popularActors;

    public function __construct($popularMovies, $popularTv, $genres, $popularActors)
    {
        $this->popularMovies = $popularMovies;
        $this->popularTv = $popularTv;
        $this->genres = $genres;
        $this->popularActors = $popularActors;
    }

    public function popularMovies()
    {
        return $this->formatMovie($this->popularMovies);
    }

    public function popularTv()
    {
        return $this->formatTv($this->popularTv);
    }




    public function popularActors()
    {
        return collect($this->popularActors)->take(5)->map(function ($actor) {
            return collect($actor)->merge([
                'profile_path' => $actor['profile_path']
                    ? 'https://image.tmdb.org/t/p/w235_and_h235_face' . $actor['profile_path']
                    : 'https://ui-avatars.com/api/?size=235&name=' . $actor['name'],
                'known_for' => collect($actor['known_for'])->where('media_type', 'movie')->pluck('title')->union(
                    collect($actor['known_for'])->where('media_type', 'tv')->pluck('name')
                )->implode(', '),
            ])->only([
                'name',
                'id',
                'profile_path',
                'known_for',
            ]);
        });
    }


    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }


    private function formatMovie($movies)
    {
        return collect($movies)->take(10)->map(function ($movie) {
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10 . '%',
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path',
                'id',
                'genre_ids',
                'title',
                'vote_average',
                'overview',
                'release_date',
                'genres',
            ]);
        });
    }

    private function formatTv($tv)
    {
        return collect($tv)->take(5)->map(function ($tvshow) {
            $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($tvshow)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $tvshow['poster_path'],
                'vote_average' => $tvshow['vote_average'] * 10 . '%',
                'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path',
                'id',
                'genre_ids',
                'name',
                'vote_average',
                'overview',
                'first_air_date',
                'genres',
            ]);
        });
    }




    public function heroSlides()
    {
        $movies = collect($this->popularMovies)
            ->map(fn($movie) => $this->formatHeroItem($movie, 'movie'));

        $tvShows = collect($this->popularTv)
            ->map(fn($show) => $this->formatHeroItem($show, 'tv'));

        return $movies
            ->concat($tvShows)
            ->sortByDesc('popularity')
            ->take(5)
            ->values();
    }

    private function formatHeroItem(array $item, string $mediaType): array
    {
        $isMovie = $mediaType === 'movie';

        $date = $isMovie
            ? ($item['release_date'] ?? null)
            : ($item['first_air_date'] ?? null);

        $backdrop = $item['backdrop_path'] ?? null;
        $poster = $item['poster_path'] ?? null;

        return [
            'id' => $item['id'],
            'media_type' => $mediaType,
            'title' => $isMovie
                ? ($item['title'] ?? 'Untitled')
                : ($item['name'] ?? 'Untitled'),
            'overview' => $item['overview'] ?? '',
            'backdrop_path' => $backdrop
                ? 'https://image.tmdb.org/t/p/w1280' . $backdrop
                : ($poster
                    ? 'https://image.tmdb.org/t/p/w500' . $poster
                    : null),
            'poster_path' => $poster
                ? 'https://image.tmdb.org/t/p/w500' . $poster
                : null,
            'vote_average' => isset($item['vote_average'])
                ? round($item['vote_average'] * 10) . '%'
                : 'N/A',
            'release_date' => $date
                ? \Carbon\Carbon::parse($date)->format('M d, Y')
                : 'Coming soon',
            'popularity' => $item['popularity'] ?? 0,
        ];
    }
}
