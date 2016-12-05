<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'street_address', 'city', 'province', 'postal_code', 'genre', 'min_price', 'max_price', 'latitude', 'longitude'
    ];

    /**
     * Gets the User that created this Restaurant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Determines if a User can edit a Restaurant's information.
     *
     * @param User $user
     * @return bool
     */
    public function userCanEdit(User $user)
    {
        return $user->id === $this->user_id;
    }

    /**
     * Defines a one-to-many relationship between a Restaurant and Reviews.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }



}
