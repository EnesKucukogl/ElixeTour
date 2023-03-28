<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccomodationType extends Model
{
    use HasFactory;

    protected $table = 'vew_accomodation_type';

    public static function hotelAccomodationTypeList($hotel_id)
    {
        return static::where("active", "=", "1")->where("hotel_id", "=", $hotel_id)->get();
    }

    public static function hotelAccomodationTypeSingleList($hotel_id, $accomodation_id)
    {
        return static::where("active", "=", "1")->where("hotel_id", "=", $hotel_id)->where("accomodation_id", "=", $accomodation_id)->get();
    }
}
