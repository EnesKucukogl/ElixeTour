<?php

namespace App\Http\Controllers;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function storeLanguage($textContentId, $languageId, $translation)
    {
        try {
            $data = DB::Table('vew_language_translation')
                ->where('text_content_id', $textContentId)
                ->where('language_id', $languageId)
                ->first();

            if ($languageId == $this->default_lang)
            {
                DB::Table('elx_text_content')->where('Id', $textContentId)->update(array(
                    'original_text' => $translation,
                    'updated_user_id' => Auth::user()->Id,
                    'updated_date' => date("Y-m-d H:i:s"),
                ));
            }
            else
            {
                if ($data)
                {
                    DB::Table('elx_translation')
                        ->where('text_content_id', $textContentId)
                        ->where('language_id', $languageId)
                        ->update(array(
                            'translation' => $translation,
                            'updated_user_id' => Auth::user()->Id,
                            'updated_date' => date("Y-m-d H:i:s"),
                        ));
                }
                else
                {
                    DB::Table('elx_translation')->insert([
                        'text_content_id' => $textContentId,
                        'language_id' => $languageId,
                        'translation' => $translation,
                        'created_user_id' => Auth::user()->Id
                    ]);
                }
            }
        }
        catch(Exception $e)
        {
            return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
        }

    }
}
