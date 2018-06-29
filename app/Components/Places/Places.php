<?php

namespace Handytravelers\Components\Places;

use Handytravelers\Components\Places\Models\Place;
use Illuminate\Support\Facades\Log;
use SKAgarwal\GoogleApi\Exceptions\GooglePlacesApiException;
use SKAgarwal\GoogleApi\PlacesApi;
use Cviebrock\EloquentSluggable\Sluggable;

class Places
{

    //TODO change to be able to handle places with same name
    public static function setLocation($data)
    {
        if (!isset($data['country'])) {
            Log::info("Country not found in Google for: ".json_encode($data));
            throw new GooglePlacesApiException;
        }

        $country = Place::where('name', '=', $data['country'])->firstOrFail();

        if (! empty($data['state']) && ! $state = static::getRealPlace(['state' => $data['state'], 'country' => $data['country']], 'state')) {
            $state = $country->children()->create(['name' => $data['state'], 'type' => 'state']);
            $city = $state->children()->create(['name' => $data['city'], 'place_id' => $data['place_id'], 'lat' => $data['lat'], 'lng' => $data['lng'], 'type' => 'city']);

            $data['country'] = $country->getAttribute('id');
            $data['state'] = $state->getAttribute('id');
            $data['city'] = $city->getAttribute('id');
            $data['slug'] = $city->slug;

            return $data;
        }

        if (! $city = static::getRealPlace(['city' => $data['city'], 'country' => $data['country']])) {
            if (empty($data['state'])) {
                $parent = $country;
            } else {
                $parent = $state;
            }

            $city = $parent->children()->create(['name' => $data['city'], 'place_id' => $data['place_id'], 'lat' => $data['lat'], 'lng' => $data['lng'], 'type' => 'city']);
        }


        $data['country'] = $country->getAttribute('id');
        if (isset($state)) {
            $data['state'] = $state->getAttribute('id');
        }
        $data['city'] = $city->getAttribute('id');
        $data['slug'] = $city->slug;

        return $data;
    }

    public static function setPlace($placeName)
    {
        $googlePlaces = new PlacesApi(env('GOOGLE_API_KEY_SERVER'));

        try {
            $placeInfo = $googlePlaces->textSearch($placeName);
            $placeDetails = $googlePlaces->placeDetails($placeInfo['results'][0]['place_id']);
        } catch (GooglePlacesApiException $e) {
            Log::emergency('GooglePlacesApiException: ' . $e->getMessage());
            return null;
        }

        $place = [];

        foreach ($placeDetails['result']['address_components'] as $placeDetail) {
            if ($placeDetail['types'][0] == 'country') {
                $place['country'] = $placeDetail['long_name'];
            }
            if ($placeDetail['types'][0] == 'administrative_area_level_1') {
                $place['state'] = $placeDetail['long_name'];
            }
        }

        $place['city'] = $placeDetails['result']['address_components'][0]['long_name'];
        $place['place_id'] = $placeInfo['results'][0]['place_id'];
        $place['lng'] = $placeDetails['result']['geometry']['location']['lng'];
        $place['lat'] = $placeDetails['result']['geometry']['location']['lat'];

        return static::setLocation($place);
    }


    public static function getPlaceFullName($place)
    {
        if (!$place) {
            return null;
        }

        $placeName = $place->name;

        foreach ($place->getAncestors() as $place) {
            if ($place->type == 'country') {
                $placeName .= ', ' . $place->name;
            }
        }

        return $placeName;
    }


    
    public static function getRealPlace($data = null, $type = 'city', $place = null)
    {
        if (!is_null($place)) {
            $place = explode(',', $place);

            if (count($place) > 1) {
                $data['country'] = trim(array_pop($place));
                $place = explode('-', $place[0]);
                $data['city'] = trim($place[0]);
            } else {
                $place = explode(' ', $place[0]);

                $data['country'] = trim(array_pop($place));
                $data['city'] = trim(implode(' ', $place));
            }
        }

        $place = Place::where('name', $data[$type])->where('type', '=', $type)->get();

        if (empty($place[0])) {
            return false;
        }

        //search for the right place comparing the country
        for ($i=0;$i<count($place);$i++) {
            $ancestors = $place[$i]->getAncestors();

            foreach ($ancestors as $ancestor) {
                if ($ancestor->name == $data['country'] && $ancestor->type == 'country') {
                    return $place[$i];
                }
            }
        }
    }
}
