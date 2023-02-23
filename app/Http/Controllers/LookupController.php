<?php

namespace App\Http\Controllers;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class LookupController extends Controller
{
    public function getCities(Request $request)
    {
        $cities = City::where('country_id', $request->ulkeId)->get();
        return response()-> json($cities);
    }

    public function getCity(Request $request)
    {
        $city = City::find($request->id);
        return response()-> json($city);
    }

    public function getCountries()
    {
        $countries = Country::all();
        return response()-> json($countries);
    }

    public function getCountry(Request $request)
    {
        $country = Country::find($request->id);
        return response()-> json($country);
    }
}
