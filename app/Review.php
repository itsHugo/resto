<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'restaurant_id' ,'title', 'rating', 'content'
    ];


    /**
     * Associates a User with the Review.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

    /**
     * Indicates if a User owns a Review.
     *
     * @param User $user
     * @return bool
     */
    public function userCanEdit(User $user)
    {
        return $user->id === $this->user_id;
    }

}
