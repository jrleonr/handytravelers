<?php

namespace Handytravelers\Components\Homes\Models;

use Handytravelers\Components\Users\Models\User;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    /**
     * The attributes that can be set with Mass Assignment.
     *
     * @var array
     */
    protected $fillable = ['invitation_id', 'user_id', 'last_read'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['last_read'];

    /**
     * Invitation relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }

    /**
     * User relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }    

    public function scopeWithoutUser($query, $user)
    {
        return $query->with('user')->where('user_id', '<>', $user->id);
    }
}
