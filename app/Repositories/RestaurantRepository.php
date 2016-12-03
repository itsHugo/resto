<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 2016-12-02
 * Time: 6:24 PM
 */

namespace App\Repositories;

use App\Restaurant;

class RestaurantRepository
{
    public function forUser(User $user){
        return $user->restaurants()->orderBy('created_at', 'asc')->get();
    }
}