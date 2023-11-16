<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop',
        'date',
        'start_time',
        'number',
        'shop_id',
        'user_id'
    ];
    
    public function users()
    {
        return $this->belongsTo('App\Models\User', "user_id");
    }
    public function shops()
    {
        return $this->belongsTo('App\Models\Shop', "shop_id");
    }
}
