<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{

    public function update(User $user, Post $post)
    {
        return $post->author->is($user);
    }

    public function delete(User $user, Post $post)
    {
        return $post->author->is($user);
    }

    public function edit(User $user, Post $post)
    {
        return $this->update($user, $post);
    }

}
