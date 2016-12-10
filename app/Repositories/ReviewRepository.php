<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 2016-12-02
 * Time: 6:26 PM
 */

namespace App\Repositories;

use App\User;
use App\Restaurant;

/**
 * Class ReviewRepository
 * @package App\Repositories
 */
class ReviewRepository
{
    /**
     * Retrieves all the reviews written by the given user.
     *
     * @param User $user
     * @return mixed
     */
    public function forUser(User $user){
        return $user->reviews()->orderBy('created_at', 'asc')->get();
    }

    /**
     * Retrieves all the reviews for the given restaurant.
     *
     * @param Restaurant $restaurant
     * @return mixed
     */
    public function forRestaurant(Restaurant $restaurant){
        return $restaurant->reviews()->orderBy('created_at', 'desc');
    }
}