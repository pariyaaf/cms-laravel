<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parent_id',
        'comment',
        'commentable_id',
        'commentable_type',
        'approve'
    ];
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'parent_id','id')->where('approved',1)->latest();
    }

    public function setCommentAttribute( $value) {
        $this->attributes['comment'] = str_replace(PHP_EOL , "<br>" , $value);

    }
}
