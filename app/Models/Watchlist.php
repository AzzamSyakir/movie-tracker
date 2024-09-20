<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Watchlist extends Model
{
    use HasFactory;

    protected $table = 'watchlists';
    protected $fillable = ['user_id', 'id'];
    public $incrementing = false;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function watchlistMovies()
    {
        return $this->hasMany(WatchlistMovie::class, 'watchlist_id');
    }
}
