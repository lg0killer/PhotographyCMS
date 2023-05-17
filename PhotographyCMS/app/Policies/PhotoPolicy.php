<?php

namespace App\Policies;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotoPolicy
{
    public function before(User $user): ?bool
    {
        if ($user->is_admin) {
            return true;
        }
        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Photo $photo): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Photo $photo): bool
    {
        return $user->id === $photo->by_user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Photo $photo): bool
    {
        return $user->id === $photo->by_user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Photo $photo): bool
    {
        return $user->id === $photo->by_user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Photo $photo): bool
    {
        return $user->id === $photo->by_user_id;
    }
}
