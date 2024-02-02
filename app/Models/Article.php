<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
// use Illuminate\Database\Eloquent\Relations\HasMany;


class Article extends Model
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
        return "/articles/$this->slug";

    }

    // relate
    // public function article () {
    //     return $this->hasMany(User::class);
    // }
}
