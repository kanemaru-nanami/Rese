<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop',
        'region',
        'genre',
        'store_overview',
        'URL'
    ];

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }

    public function favorites()
    {
        return $this->hasMany('App\Models\Favorite');
    }

    public function scopeRegionSearch($query, $region)
    {
        if (!empty($region)) {
            $query->where('region', $region);
        }
    }

    public function scopeGenreSearch($query, $genre)
    {
        if (!empty($genre)) {
            $query->where('genre', $genre);
        }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('content', 'like', '%' . $keyword . '%');
        }
    }
}
