<?php

namespace App\Http\Controllers\api_controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class api_controller
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('TMDB_API_KEY');
    }

    public function getPopularMovies()
    {
        try {
            $response = Http::get('https://api.themoviedb.org/3/movie/popular', [
                'api_key' => $this->apiKey
            ]);
    
            if ($response->successful()) {
                return $response->json('results');
            } else {
                throw new \Exception('API response error with status code: ' . $response->status());
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch popular movies: ' . $e->getMessage());
        }
    }
    
    public function getMovieDetails($id)
    {
        try {
            $response = Http::get("https://api.themoviedb.org/3/movie/{$id}", [
                'api_key' => $this->apiKey
            ]);

            if ($response->successful()) {
                return $response->json();
            } else {
                throw new \Exception('API response error with status code: ' . $response->status());
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch movie details: ' . $e->getMessage());
        }
    }
    

    
}

