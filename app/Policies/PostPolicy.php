<?php
namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the post.
     */
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id; // Solo el autor puede editar
    }

    /**
     * Determine whether the user can delete the post.
     */
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id; // Solo el autor puede eliminar
    }
}