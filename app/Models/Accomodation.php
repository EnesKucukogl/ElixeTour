<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    use HasFactory;


    protected $table = 'vew_accomodation';

    public function hotelAccomodation()
    {
        return $this->hasMany('App\Models\HotelAccomodation', 'accomodation_id', 'Id');
    }

    public static function hotelAccomodationList($hotel_Id)
    {
        return static::whereHas('hotelAccomodation', function ($query) use ($hotel_Id) {
            $query->where('hotel_id', $hotel_Id);
        })->where("active", "=", "1")->orderBy("Id", "desc")->get();
    }

}
