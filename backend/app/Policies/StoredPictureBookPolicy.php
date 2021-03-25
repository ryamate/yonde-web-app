<?php

namespace App\Policies;

use App\StoredPictureBook;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoredPictureBookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any stored picture books.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the stored picture book.
     *
     * @param  \App\User  $user
     * @param  \App\StoredPictureBook  $storedPictureBook
     * @return mixed
     */
    public function view(?User $user, StoredPictureBook $storedPictureBook)
    {
        return true;
    }

    /**
     * Determine whether the user can create stored picture books.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the stored picture book.
     *
     * @param  \App\User  $user
     * @param  \App\StoredPictureBook  $storedPictureBook
     * @return mixed
     */
    public function update(User $user, StoredPictureBook $storedPictureBook)
    {
        return $user->id === $storedPictureBook->user_id;
    }

    /**
     * Determine whether the user can delete the stored picture book.
     *
     * @param  \App\User  $user
     * @param  \App\StoredPictureBook  $storedPictureBook
     * @return mixed
     */
    public function delete(User $user, StoredPictureBook $storedPictureBook)
    {
        return $user->id === $storedPictureBook->user_id;
    }

    /**
     * Determine whether the user can restore the stored picture book.
     *
     * @param  \App\User  $user
     * @param  \App\StoredPictureBook  $storedPictureBook
     * @return mixed
     */
    public function restore(User $user, StoredPictureBook $storedPictureBook)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the stored picture book.
     *
     * @param  \App\User  $user
     * @param  \App\StoredPictureBook  $storedPictureBook
     * @return mixed
     */
    public function forceDelete(User $user, StoredPictureBook $storedPictureBook)
    {
        //
    }
}
