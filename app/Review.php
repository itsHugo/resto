<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 * @package App
 */
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
     * Returns the user that this review belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns the restaurant that this review belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
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
