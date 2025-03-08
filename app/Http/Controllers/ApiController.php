<?php

namespace App\Http\Controllers;

use Cache;
use Config;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Promise;


class ApiController
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('api.key');
    }
    // movie list

    public function getPopularMovies()
    {
        $baseUrl = 'https://api.themoviedb.org/3/discover/movie';
        $allMovies = [];
        $client = new \GuzzleHttp\Client();
        $randomPages = range(1, 20);
        shuffle($randomPages);

        try {
            foreach (array_slice($randomPages, 0, 5) as $page) {
                $response = $client->get($baseUrl, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->apiKey,
                        'Accept' => 'application/json'
                    ],
                    'query' => [
                        'language' => 'en-US',
                        'region' => 'US',
                        'page' => $page,
                        'include_adult' => false,
                        'certification_country' => 'US',
                        'certification.gte' => 'PG',
                        'certification.lte' => 'PG-13',
                        'sort_by' => 'popularity.desc',
                    ]
                ]);



                if ($response->getStatusCode() === 200) {
                    $data = json_decode($response->getBody()->getContents(), true)['results'];
                    foreach ($data as $movie) {
                        if (!empty($movie['poster_path'])) {
                            $allMovies[] = $movie;
                            if (count($allMovies) >= 30) {
                                break 2; // Breaks out of both the foreach loop and the page loop
                            }
                        }
                    }
                } else {
                    throw new \Exception('API Response Error: ' . $response->getReasonPhrase());
                }
            }

            return array_slice($allMovies, 0, 30);
        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch movies: ' . $e->getMessage());
        }
    }
    public function GetTopRatedMovies()
    {
        $baseUrl = 'https://api.themoviedb.org/3/discover/movie';
        $allMovies = [];
        $client = new \GuzzleHttp\Client();
        $randomPages = range(1, 20);
        shuffle($randomPages);

        try {
            foreach (array_slice($randomPages, 0, 5) as $page) {
                $response = $client->get($baseUrl, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->apiKey,
                        'Accept' => 'application/json'
                    ],
                    'query' => [
                        'language' => 'en-US',
                        'region' => 'US',
                        'page' => $page,
                        'include_adult' => false,
                        'certification_country' => 'US',
                        'certification.gte' => 'PG',
                        'certification.lte' => 'PG-13',
                        'sort_by' => 'vote_average.desc',
                    ]
                ]);


                if ($response->getStatusCode() === 200) {
                    $data = json_decode($response->getBody()->getContents(), true)['results'];
                    foreach ($data as $movie) {
                        if (!empty($movie['poster_path'])) {
                            $allMovies[] = $movie;
                            if (count($allMovies) >= 30) {
                                break 2; // Breaks out of both the foreach loop and the page loop
                            }
                        }
                    }
                } else {
                    throw new \Exception('API Response Error: ' . $response->getReasonPhrase());
                }
            }

            return array_slice($allMovies, 0, 30);

        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch movies: ' . $e->getMessage());
        }
    }
    public function GetNowPlayingMovies()
    {
        $baseUrl = 'https://api.themoviedb.org/3/discover/movie';
        $allMovies = [];
        $client = new \GuzzleHttp\Client();
        $randomPages = range(1, 20);
        shuffle($randomPages);

        try {
            foreach (array_slice($randomPages, 0, 5) as $page) {
                $response = $client->get($baseUrl, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->apiKey,
                        'Accept' => 'application/json'
                    ],
                    'query' => [
                        'language' => 'en-US',
                        'region' => 'US',
                        'page' => $page,
                        'include_adult' => false,
                        'certification_country' => 'US',
                        'certification.gte' => 'PG',
                        'certification.lte' => 'PG-13',
                        'sort_by' => 'primary_release_date.desc',
                    ]
                ]);


                if ($response->getStatusCode() === 200) {
                    $data = json_decode($response->getBody()->getContents(), true)['results'];
                    foreach ($data as $movie) {
                        if (!empty($movie['poster_path'])) {
                            $allMovies[] = $movie;
                            if (count($allMovies) >= 30) {
                                break 2; // Breaks out of both the foreach loop and the page loop
                            }
                        }
                    }
                } else {
                    throw new \Exception('API Response Error: ' . $response->getReasonPhrase());
                }
            }

            return array_slice($allMovies, 0, 30);

        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch movies: ' . $e->getMessage());
        }
    }
    public function GetMoviesByCountry($country)
    {
        $baseUrl = 'https://api.themoviedb.org/3/discover/movie';
        $randomNumber1 = rand(1, 20);
        $randomNumber2 = rand(1, 20);
        try {
            $responsePage1 = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json'
            ])->get($baseUrl, [
                        'page' => $randomNumber1,
                        'with_origin_country' => $country,
                        'include_adult' => false
                    ]);

            $responsePage2 = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json'
            ])->get($baseUrl, [
                        'page' => $randomNumber2,
                        'with_origin_country' => $country,
                        'include_adult' => false
                    ]);

            if ($responsePage1->successful() && $responsePage2->successful()) {
                $dataPage1 = $responsePage1->json('results');
                $dataPage2 = $responsePage2->json('results');

                $filteredMoviesPage1 = array_filter($dataPage1, function ($movie) {
                    return !$movie['adult'];
                });

                $filteredMoviesPage2 = array_filter($dataPage2, function ($movie) {
                    return !$movie['adult'];
                });

                $allMovies = array_merge($filteredMoviesPage1, $filteredMoviesPage2);
                $selectedMovies = array_slice($allMovies, 0, 30);
                return $selectedMovies;
            } else {
                $errorMessagePage1 = $responsePage1->json('status_message') ?? 'No error message provided';
                $errorMessagePage2 = $responsePage2->json('status_message') ?? 'No error message provided';

                throw new \Exception('API response error. Page 1: ' . $errorMessagePage1 . ' Page 2: ' . $errorMessagePage2);
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch popular movies: ' . $e->getMessage());
        }
    }

    public function getMovieDetails($id)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json'
            ])->get("https://api.themoviedb.org/3/movie/" . $id);

            if ($response->successful()) {
                return $response->json();
            } else {
                $responseData = json_decode($response->body(), true);
                $errorMessage = isset($responseData['status_message']) ? $responseData['status_message'] : 'No error message provided';

                throw new \Exception('API response error with status code: ' . $response->status() . ' and message: ' . $errorMessage);
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch movie details: ' . $e->getMessage());
        }
    }

    public function getMovieVideos($id)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json'
            ])->get("https://api.themoviedb.org/3/movie/" . $id . "/videos");

            if ($response->successful()) {
                return $response->json('results');
            } else {
                $responseData = json_decode($response->body(), true);
                $errorMessage = isset($responseData['status_message']) ? $responseData['status_message'] : 'No error message provided';

                throw new \Exception('API response error with status code: ' . $response->status() . ' and message: ' . $errorMessage);
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch movie videos: ' . $e->getMessage());
        }
    }

    public function SearchMovie($query)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json'
            ])->get("https://api.themoviedb.org/3/search/movie", [
                        'query' => $query,
                        'include_adult' => false
                    ]);

            if ($response->successful()) {
                $movies = $response->json('results');
                return $movies;
            } else {
                $responseData = json_decode($response->body(), true);
                $errorMessage = isset($responseData['status_message']) ? $responseData['status_message'] : 'No error message provided';

                throw new \Exception('API response error with status code: ' . $response->status() . ' and message: ' . $errorMessage);
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch movie details: ' . $e->getMessage());
        }
    }
}