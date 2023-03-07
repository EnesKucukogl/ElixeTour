<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Package extends Model
{
    use HasFactory,Sluggable;


    protected $table = 'vew_package';

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

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
        return static::with("packageTextContent")->with("descriptionTextContent")->orderBy("Id","desc")->get();
    }

    public static function packageListActive()
    {
        return static::with("packageTextContent")->with("descriptionTextContent")->where("active","=","1")->orderBy("Id","desc")->get();
    }


}
