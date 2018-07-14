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
        $place = $this->place;

        if(!$place) {
            return [];
        }
        
        $this->users;

        $array = $this->toArray();

        unset(
            $array['place'], $array['place_id'], $array['id'],
            $array['summary'], $array['rules'], $array['interaction'],
            $array['accommodation'], $array['getting_around'], $array['other']
        );

        //set places
        $array['_geoloc']['lat'] = floatval($place->lat);
        $array['_geoloc']['lng'] = floatval($place->lgn);
        $array['places']['city'] = $place->name;
        $ancestors = $place->getAncestors();
        foreach ($ancestors as $a) {
           $array['places'][$a['type']] = $a->name;
        }

        return $array;
    }
}
