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
        'name', 'address', 'genre', 'min_price', 'max_price', 'latitude', 'longitude'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function userCanEdit(User $user)
    {
        return $user->id === $this->user_id;
    }




}
