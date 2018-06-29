<?php

namespace Handytravelers\Components\Places\Models;

use Baum\Node as Nestedset;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Place extends Nestedset
{
    use Sluggable;

    protected $table = 'places';
    protected $parentColumn = 'parent_id';
    protected $leftColumn = 'lft';
    protected $rightColumn = 'rgt';
    protected $depthColumn = 'depth';
    protected $guarded = ['id', 'parent_id', 'lft', 'rgt', 'depth'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getFullPlace()
    {
        $placeName = $this->name;

        foreach ($this->getAncestors() as $place) {
            if ($place->type == 'country') {
                $placeName .= ', ' . $place->name;
            }
        }

        return $placeName;
    }

    public static function getPlacesAroundIdsArray($placeId)
    {
        return static::getPlacesAround($placeId)->pluck('id')->toArray();
    }

    public static function getPlacesAround($placeId, $distance = 40)
    {
        // To search by kilometers instead of miles, replace 3959 (miles) with 6371 (km).
        $kms = 6371;
        $miles = 3959;

        $place = static::find($placeId);

        $places = static::select(\DB::raw("id, name,  ( $kms * acos( cos( radians($place->lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($place->lng) ) + sin( radians($place->lat) ) * sin( radians( lat ) ) ) ) AS distance"))
            ->having('distance', '<', $distance)
            ->orderBY('distance')
            ->get();

        return $places;
    }
}
