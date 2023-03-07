<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;
    protected $table = 'vew_treatment';



    public  function treatmentTextContent()
    {
        return $this->hasMany('App\Models\TranslationView', 'text_content_id', 'treatment_name_content_id');
    }

    public  function descriptionTextContent()
    {
        return $this->hasMany('App\Models\TranslationView', 'text_content_id', 'description_content_id');
    }


    public static function treatmentList()
    {
        return static::with("treatmentTextContent")->with("descriptionTextContent")->get();
    }


}
