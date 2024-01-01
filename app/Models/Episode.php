<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;

class Episode extends Model
{
    use Sluggable;

    use HasFactory;

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'//منبع اسلاگ رو مشخص میکنیم.
            ]
        ];
    } 


    public function path ()
    {
        return "/course/{$this->course->slug}/epicode/{$this->episodeNumber}";

    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }}
