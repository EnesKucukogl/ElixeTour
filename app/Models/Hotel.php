<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Hotel extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'vew_hotel';

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


    public static function hotelList()
    {
        return static::orderBy("Id","desc")->get();
    }

    public static function hotelListActive()
    {
        return static::where("active","=","1")->orderBy("Id","desc")->get();
    }

    public static function hotelSingleSlug($slug)
    {
        return static::where("active","=","1")->where("slug","=",$slug)->first();
    }


}
