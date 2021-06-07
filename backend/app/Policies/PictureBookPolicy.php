<?php

namespace App\Policies;

use App\PictureBook;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PictureBookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any picture books.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the picture book.
     *
     * @param  \App\User  $user
     * @param  \App\PictureBook  $pictureBook
     * @return mixed
     */
    public function view(?User $user, PictureBook $pictureBook)
    {
        return true;
    }

    /**
     * Determine whether the user can create picture books.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the picture book.
     *
     * @param  \App\User  $user
     * @param  \App\PictureBook  $pictureBook
     * @return mixed
     */
    public function update(User $user, PictureBook $pictureBook)
    {
        return $user->family_id === $pictureBook->family_id;
    }

    /**
     * Determine whether the user can delete the picture book.
     *
     * @param  \App\User  $user
     * @param  \App\PictureBook  $pictureBook
     * @return mixed
     */
    public function delete(User $user, PictureBook $pictureBook)
    {
        return $user->family_id === $pictureBook->family_id;
    }

    /**
     * Determine whether the user can restore the picture book.
     *
     * @param  \App\User  $user
     * @param  \App\PictureBook  $pictureBook
     * @return mixed
     */
    public function restore(User $user, PictureBook $pictureBook)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the picture book.
     *
     * @param  \App\User  $user
     * @param  \App\PictureBook  $pictureBook
     * @return mixed
     */
    public function forceDelete(User $user, PictureBook $pictureBook)
    {
        //
    }
}
