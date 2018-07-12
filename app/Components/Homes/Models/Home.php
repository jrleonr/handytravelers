<?php

namespace Handytravelers\Components\Homes\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Handytravelers\Components\Users\Models\User;
use Handytravelers\Components\Places\Models\Place;

class Home extends Model
{
    use Searchable;

    protected $guarded = [];

    public function isFilled()
    {
        if($this->summary)
        {
            return true;
        }

        return false;
    }

    public function shouldBeSearchable()
    {
        return $this->isFilled();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPlaceId()
    {
        return $this->place_id;
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        if(!$this->place) {
            return [];
        }

        $array = $this->toArray();

        $place = $this->place;
        $array['city'] = $place->name;
        $users = $this->users;
        foreach ($users as $user) {
            $array['users']['username'] = $user->username;
            $array['users']['first_name'] = $user->first_name;
            $array['users']['image'] = $user->getMainPhoto(300);
        }
        
        $ancestors = $place->getAncestors();

        foreach ($ancestors as $a) {
           $array[$a['type']] = $a->name;
        }

        return $array;
    }
}
