<?php

namespace App\Policies;

use App\User;
use App\Restaurant;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class RestaurantPolicy
 * @package App\Policies
 */
class RestaurantPolicy
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
     * Determines if the given user can destroy the given restaurant.
     *
     * @param User $user
     * @param Restaurant $restaurant
     * @return bool
     */
    public function destroy(User $user, Restaurant $restaurant){
        return $user->id === $restaurant->user_id;
    }

    /**
     * Determines if the given user can edit the given restaurant.
     *
     * @param User $user
     * @param Restaurant $restaurant
     * @return bool
     */
    public function edit(User $user, Restaurant $restaurant){
        return $user->id === $restaurant->user_id;
    }
}
