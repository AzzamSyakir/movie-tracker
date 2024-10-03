<?php

namespace App\Http\Controllers;

use Cache;
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
            $allMovies = [];
            $page = rand(1, 20);

            try {
                while (count($allMovies) < 30) {
                    $response = Http::get($baseUrl, [
                        'api_key' => $this->apiKey,
                        'page' => $page,
                        'include_adult' => false
                    ]);

                    if ($response->successful()) {
                        $data = $response->json('results');
                        $filteredMovies = $this->FilterMovieByMpaa($data);
                        $allMovies = array_merge($allMovies, $filteredMovies);
                        $page++;
                    } else {
                        $errorMessage = $response->json('status_message') ?? 'No error message provided';
                        throw new \Exception('API response error: ' . $errorMessage);
                    }
                }
                return array_slice($allMovies, 0, 30);
            } catch (\Exception $e) {
                throw new \Exception('Failed to fetch Popular movies: ' . $e->getMessage());
            }
    }

    public function GetTopRatedMovies(){
            $baseUrl = 'https://api.themoviedb.org/3/movie/top_rated';
            $allMovies = [];
            $page = rand(1, 20);
    
            try {
                while (count($allMovies) < 30) {
                    $response = Http::get($baseUrl, [
                        'api_key' => $this->apiKey,
                        'page' => $page,
                        'include_adult' => false
                    ]);
    
                    if ($response->successful()) {
                        $data = $response->json('results');
                        $filteredMovies = $this->FilterMovieByMpaa($data);
                        $allMovies = array_merge($allMovies, $filteredMovies);
                        $page++;
                    } else {
                        $errorMessage = $response->json('status_message') ?? 'No error message provided';
                        throw new \Exception('API response error: ' . $errorMessage);
                    }
                }
                return array_slice($allMovies, 0, 30);
            } catch (\Exception $e) {
                throw new \Exception('Failed to fetch TopRated movies: ' . $e->getMessage());
            }
    }
    public function GetNowPlayingMovies(){
            $baseUrl = 'https://api.themoviedb.org/3/movie/top_rated';
            $allMovies = [];
            $page = rand(1, 20);
    
            try {
                while (count($allMovies) < 30) {
                    $response = Http::get($baseUrl, [
                        'api_key' => $this->apiKey,
                        'page' => $page,
                        'include_adult' => false
                    ]);
    
                    if ($response->successful()) {
                        $data = $response->json('results');
                        $filteredMovies = $this->FilterMovieByMpaa($data);
                        $allMovies = array_merge($allMovies, $filteredMovies);
                        $page++;
                    } else {
                        $errorMessage = $response->json('status_message') ?? 'No error message provided';
                        throw new \Exception('API response error: ' . $errorMessage);
                    }
                }
    
                return array_slice($allMovies, 0, 30);
            } catch (\Exception $e) {
                throw new \Exception('Failed to fetch nowPlaying movies: ' . $e->getMessage());
            }
    }
    public function FilterMovieByMpaa($movies) {
        $certificationArray = [];
        $movieFiltered = [];
    
        if (is_array($movies) && !empty($movies)) {
            foreach ($movies as $filterMovie) {
                $movieId = $filterMovie['id'];
                $movieMpaaRating = Http::get("https://api.themoviedb.org/3/movie/" . $movieId . "/release_dates", [
                    'api_key' => $this->apiKey,
                ]);
    
                if ($movieMpaaRating->successful()) {
                    $releaseDates = $movieMpaaRating->json('results');
    
                    if (!empty($releaseDates)) {
                        foreach ($releaseDates as $release) {
                            if ($release['iso_3166_1'] === 'US') {
                                $certification = $release['release_dates'][0]['certification'] ?? 'N/A';
    
                                if ($certification !== '' && $certification !== 'NC-17' && $certification !== 'R' && $certification !== '' && $certification !== 'NR') {
                                    $certificationArray[]['certification'] = [
                                        'movie_id' => $filterMovie['id'],
                                        'certification' => $certification
                                    ];
                                }
                                break;
                            }
                        }
                    }
                }
            }
        }
        if (!empty($certificationArray)) {
            foreach ($certificationArray as $movieCertificate) {
                foreach ($movies as $movie) {
                    if ($movie['id'] == $movieCertificate['certification']['movie_id']) {
                        $movieFiltered [] = $movie;
                    }
                }
            }
        }
        return $movieFiltered;
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
                'include_adult' => false
            ]);

            $responsePage2 = Http::get($baseUrl, [
                'api_key' => $this->apiKey,
                'page' => $randomNumber2,
                'with_origin_country' => $country,
                'include_adult' => false
            ]);

            if ($responsePage1->successful() && $responsePage2->successful()) {
                $dataPage1 = $responsePage1->json('results');
                $dataPage2 = $responsePage2->json('results');

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
    public function getMovieDetails($id)
    {
        try {
            $response = Http::get("https://api.themoviedb.org/3/movie/" . $id, [
                'api_key' => $this->apiKey,
            ]);
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
            $response = Http::get("https://api.themoviedb.org/3/movie/" . $id . "/videos", [
                'api_key' => $this->apiKey,
            ]);
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
            $response = Http::get("https://api.themoviedb.org/3/search/movie", [
                'api_key' => $this->apiKey,
                'query' => $query,
                'include_adult' => false
            ]);

            if ($response->successful()) {
                $movies = $response->json('results');

                $filteredMovies = array_filter($movies, function($movie) {
                    return !$movie['adult'];
                });

                return $filteredMovies;
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

