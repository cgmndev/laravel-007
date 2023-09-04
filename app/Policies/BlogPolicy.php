<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BlogPolicy
{
    public function update(User $user, Blog $blog): bool
    {
        return $blog->user()->is($user);
    }

    public function delete(User $user, Blog $blog): bool
    {
        return $this->update($user, $blog);
    }
}
