<?php

namespace App\Http\Controllers;

use Config;
use Illuminate\Support\Facades\Http;

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
        $baseUrl = 'https://api.themoviedb.org/3/movie/popular';
        $randomNumber1 = rand(1, 20);
        $randomNumber2 = rand(1, 20);
        try {
            $responsePage1 = Http::get($baseUrl, [
                'api_key' => $this->apiKey,
                'page' => $randomNumber1,
                'include_adult' => false
            ]);

            $responsePage2 = Http::get($baseUrl, [
                'api_key' => $this->apiKey,
                'page' => $randomNumber2,
                'include_adult' => false
            ]);

            if ($responsePage1->successful() && $responsePage2->successful()) {
                $dataPage1 = $responsePage1->json('results');
                $dataPage2 = $responsePage2->json('results');

                // Filter out adult movies
                $filteredMoviesPage1 = array_filter($dataPage1, function($movie) {
                    return !$movie['adult'];
                });
                
                $filteredMoviesPage2 = array_filter($dataPage2, function($movie) {
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

    public function GetMoviesByCountry($country)
    {
        $baseUrl = 'https://api.themoviedb.org/3/discover/movie';
        $randomNumber1 = rand(1, 20);
        $randomNumber2 = rand(1, 20);
        try {
            $responsePage1 = Http::get($baseUrl, [
                'api_key' => $this->apiKey,
                'page' => $randomNumber1,
                'with_origin_country' => $country,
                'include_adult' => 'false'
            ]);

            $responsePage2 = Http::get($baseUrl, [
                'api_key' => $this->apiKey,
                'page' => $randomNumber2,
                'with_origin_country' => $country,
                'include_adult' => 'false'
            ]);

            if ($responsePage1->successful() && $responsePage2->successful()) {
                $dataPage1 = $responsePage1->json('results');
                $dataPage2 = $responsePage2->json('results');
                // Filter out adult movies
                $filteredMoviesPage1 = array_filter($dataPage1, function($movie) {
                    return !$movie['adult'];
                });

                $filteredMoviesPage2 = array_filter($dataPage2, function($movie) {
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
    public function GetTopRatedMovies(){
        $baseUrl = 'https://api.themoviedb.org/3/movie/top_rated';
        $randomNumber1 = rand(1, 20);
        $randomNumber2 = rand(1, 20);
        try {
            $responsePage1 = Http::get($baseUrl, [
                'api_key' => $this->apiKey,
                'page' => $randomNumber1,
                'include_adult' => 'false'
            ]);

            $responsePage2 = Http::get($baseUrl, [
                'api_key' => $this->apiKey,
                'page' => $randomNumber2,
                'include_adult' => 'false'
            ]);

            if ($responsePage1->successful() && $responsePage2->successful()) {
                $dataPage1 = $responsePage1->json('results');
                $dataPage2 = $responsePage2->json('results');

            // Filter out adult movies
            $filteredMoviesPage1 = array_filter($dataPage1, function($movie) {
                return !$movie['adult'];
            });

            $filteredMoviesPage2 = array_filter($dataPage2, function($movie) {
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
        }
            catch (\Exception $e) {
            throw new \Exception('Failed to fetch movie details: ' . $e->getMessage());
        }
    }
    public function GetNowPlayingMovies(){
        $randomNumber1 = rand(1, 20);
        $randomNumber2 = rand(1, 20);
        $baseUrl = 'https://api.themoviedb.org/3/movie/now_playing';
        try {
            $responsePage1 = Http::get($baseUrl, [
                'api_key' => $this->apiKey,
                'page' => $randomNumber1,
                'include_adult' => false
            ]);
    
            $responsePage2 = Http::get($baseUrl, [
                'api_key' => $this->apiKey,
                'page' => $randomNumber2,
                'include_adult' => false
            ]);
    
            if ($responsePage1->successful() && $responsePage2->successful()) {
                $dataPage1 = $responsePage1->json('results');
                $dataPage2 = $responsePage2->json('results');
    
                // Filter out adult movies
                $filteredMoviesPage1 = array_filter($dataPage1, function($movie) {
                    return !$movie['adult'];
                });
    
                $filteredMoviesPage2 = array_filter($dataPage2, function($movie) {
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
        } 
        catch (\Exception $e) {
            throw new \Exception('Failed to fetch movie details: ' . $e->getMessage());
        }
    }
    
// movies 
    public function getMovieDetails($id)
    {
        try {
            $response = Http::get("https://api.themoviedb.org/3/movie/{$id}", [
                'api_key' => $this->apiKey
            ]);
            if ($response->successful()) {
                return $response->json('results');
            } else {
                $responseData = json_decode($response->body(), true);
                $errorMessage = isset($responseData['status_message']) ? $responseData['status_message'] : 'No error message provided';

                throw new \Exception('API response error with status code: ' . $response->status() . ' and message: ' . $errorMessage);
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch movie details: ' . $e->getMessage());
        }
    }
    public function SearchMovie($query){
        try{
        $response = Http::get("https://api.themoviedb.org/3/search/movie", [
            'api_key' => $this->apiKey,
            'querry' => $query
        ]);

        if ($response->successful()) {
            return $response->json('results');
        } else {
            $responseData = json_decode($response->body(), true);
            $errorMessage = isset($responseData['status_message']) ? $responseData['status_message'] : 'No error message provided';

            throw new \Exception('API response error with status code: ' . $response->status() . ' and message: ' . $errorMessage);
        }
    }
    catch (\Exception $e) {
        throw new \Exception('Failed to fetch movie details: ' . $e->getMessage());
    }
    }
}

