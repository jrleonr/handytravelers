<?php

namespace Handytravelers\Components\Offers\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Handytravelers\Components\Users\Models\User;
use Handytravelers\Components\Places\Models\Place;

class Home extends Model
{
    use Searchable;

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

        $ancestors = $place->getAncestors();

        foreach ($ancestors as $a) {
           $array[$a['type']] = $a->name;
        }

        return $array;
    }
}
