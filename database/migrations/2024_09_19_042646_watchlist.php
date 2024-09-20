<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('watchlists', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users');
            $table->timestamps();
        });
        Schema::create('watchlist_movies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('movie_id');
            $table->foreignUuid('watchlist_id')->constrained('watchlists')->onDelete('cascade');
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('watchlists', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('is_public');
            $table->foreignUuid('user_id')->constrained('users');
            $table->timestamps();
        });
        Schema::create('watchlists_movies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('movie_id');
            $table->foreignUuid('watchlist_id')->constrained('watchlists')->onDelete('cascade');
            $table->timestamps();
        }); 
    }
};
