<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchlistMovie extends Model
{
    use HasFactory;

    protected $table = 'watchlist_movies';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = ['watchlist_id', 'movie_id', 'id'];

    public function watchlist()
    {
        return $this->belongsTo(Watchlist::class);
    }
}
