<?php

namespace App\Policies;

use App\User;
use App\Review;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determines if the given user can destroy the given review.
     *
     * @param User $user
     * @param Review $review
     * @return bool
     */
    public function destroy(User $user, Review $review){
        return $user->id === $review->user_id;
    }

    /**
     * Determines if the given user can edit the given review.
     *
     * @param User $user
     * @param Review $review
     * @return bool
     */
    public function edit(User $user, Review $review){
        return $user->id === $review->user_id;
    }
}
