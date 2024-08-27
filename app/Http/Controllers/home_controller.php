<?php
namespace App\Http\Controllers;

class home_controller
{
    public function index()
    {
        $movies = [
            ['title' => 'Inception', 'poster' => 'inception.jpg', 'rating' => 8.8],
            ['title' => 'The Dark Knight', 'poster' => 'dark_knight.jpg', 'rating' => 9.0],
            ['title' => 'Interstellar', 'poster' => 'interstellar.jpg', 'rating' => 8.6],
        ];

        return view('home', compact('movies'));
    }
}
