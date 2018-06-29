<?php

namespace Handytravelers\Components\Offers\Models;

use Handytravelers\Components\Places\Models\Place;
use Handytravelers\Components\Users\Models\User;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{

    protected $guarded = [];

    public function filled()
    {
        if($this->summary)
        {
            return true;
        }

        return false;
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
