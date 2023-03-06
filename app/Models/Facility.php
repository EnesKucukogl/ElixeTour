<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    const CREATED_AT = 'created_date';
    const UPDATED_AT  = 'updated_date';

    protected $table = 'vew_facility';


//    public function children()
//    {
//        return $this->hasMany('App\Models\Facility', 'facility_name_content_id', 'Id')->where("active",'=',"1")->orderBy('sort_order');
//    }

    public  function textContent()
    {
        return $this->hasMany('App\Models\TranslationView', 'text_content_id', 'facility_name_content_id');
    }

    public  function descriptionTextContent()
    {
        return $this->hasMany('App\Models\TranslationView', 'text_content_id', 'description_content_id');
    }

    public static function FacilityList()
    {
        return static::with("textContent")->with("descriptionTextContent")->get();
    }
}
