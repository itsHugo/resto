<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 2016-12-02
 * Time: 6:26 PM
 */

namespace App\Repositories;


class ReviewRepository
{
    public function forUser(User $user){
        return $user->reviews()->orderBy('created_at', 'asc')->get();
    }
}