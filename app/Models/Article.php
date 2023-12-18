<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
    use Sluggable;

    use HasFactory;

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
        return "/article/$this->slug";

    }
}
