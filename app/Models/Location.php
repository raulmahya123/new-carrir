<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'region',
        'country',
        'lat',   // latitude
        'lng',   // longitude
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
