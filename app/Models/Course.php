<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;

class Course extends Model
{
    use Sluggable;

    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'images' => 'array'
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
        return "/course/$this->slug";

    }


    public function setBodyAttribute($value)
    {
        $content = preg_replace('/<[^>]*>/' , '' , $value);
        $this->attributes['description'] = Str::limit($content, 500);
        $this->attributes['body'] = $value;
    }


}
