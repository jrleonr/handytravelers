<?php

namespace Handytravelers\Http\Controllers;

use Handytravelers\Components\Homes\Models\Home;
use Handytravelers\Components\Places\Models\Place;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    public function getAllCountries()
    {
        $places = Place::where('type', 'country')->get();


        return view('places.places-list', compact('places'));
    }

    public function getCountryOrContinent($country)
    {
        $homes = Home::search("{$country}")->raw()['hits'];

        $places = Place::where('type', 'country')->where('slug', $country)->first();

        $descendants =  $places->getDescendants();

        return view('places.places-show', compact('homes', 'country', 'descendants'));
    }

    public function getCity($country,$city)
    {
        $homes = Home::search("{$country} {$city}")->raw()['hits'];

        return view('places.places-show', compact('homes', 'country', 'city'));
    }
}
