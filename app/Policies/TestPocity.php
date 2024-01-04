<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;


class TestPocity
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        function view(Post $post) {
            return $user->id === $post->user_id;

        }
    }
}
