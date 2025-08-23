<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Job extends Model
{
    protected $fillable = [
        'job_category_id','location_id','title','slug','summary','description',
        'requirements','employment_type','min_salary','max_salary','currency',
        'apply_link','contact_email','status','posted_at','closed_at'
    ];

    protected $casts = [
        'posted_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public function category() { return $this->belongsTo(JobCategory::class, 'job_category_id'); }
    public function location() { return $this->belongsTo(Location::class); }

    // Hanya job yang Open dan sudah dipublish
    public function scopePublished(Builder $q): Builder
    {
        return $q->where('status','open')
                 ->whereNotNull('posted_at')
                 ->where('posted_at','<=', now());
    }

    public function scopeFilter(Builder $q, array $filters): Builder
    {
        return $q
            ->when($filters['category'] ?? null, fn($qq, $slug) =>
                $qq->whereHas('category', fn($qc) => $qc->where('slug',$slug)))
            ->when($filters['location'] ?? null, fn($qq, $locId) =>
                $qq->where('location_id', $locId))
            ->when($filters['type'] ?? null, fn($qq, $type) =>
                $qq->where('employment_type',$type))
            ->when($filters['q'] ?? null, fn($qq, $search) =>
                $qq->where(function($w) use ($search) {
                    $w->where('title','like',"%$search%")
                      ->orWhere('summary','like',"%$search%");
                }));
    }

    protected static function booted()
    {
        static::saving(function ($m) {
            if (empty($m->slug)) { $m->slug = Str::slug($m->title.'-'.Str::random(4)); }
        });
    }
}

