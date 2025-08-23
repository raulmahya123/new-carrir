<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JobCategory extends Model
{
    protected $fillable = ['name','slug'];

    public function jobs() { return $this->hasMany(Job::class); }

    protected static function booted()
    {
        static::saving(function ($m) {
            if (empty($m->slug)) { $m->slug = Str::slug($m->name); }
        });
    }
}
