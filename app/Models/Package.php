<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;


    protected $table = 'vew_package';



    public  function packageTextContent()
    {
        return $this->hasMany('App\Models\TranslationView', 'text_content_id', 'package_name_content_id');
    }

    public  function descriptionTextContent()
    {
        return $this->hasMany('App\Models\TranslationView', 'text_content_id', 'description_content_id');
    }


    public static function packageList()
    {
        return static::with("packageTextContent")->with("descriptionTextContent")->get();
    }


}
