<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;
use App\Models\episode;

class Course extends Model
{
    use Sluggable;

    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'images' => 'array'
    ];

    protected $hidden = [//  با دیدی و دسترسی مستقیم بر میگرده البته
        'viewCount',
        'commentCount',
    ];

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
        return "/courses/$this->slug";

    }


    public function setBodyAttribute($value)
    {
        $content = preg_replace('/<[^>]*>/' , '' , $value);
        $this->attributes['description'] = Str::limit($content, 500);
        $this->attributes['body'] = $value;
    }


    public function episodes()
    {
        return $this->hasMany(episode::class);
    }
}
