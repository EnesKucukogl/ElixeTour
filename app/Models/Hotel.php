<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    const CREATED_AT = 'created_date';
    const UPDATED_AT  = 'updated_date';

    protected $table = 'vew_hotel';

    protected $fillable = ['id','name','city_id','address','active','highlighted','created_user_id','created_date'];

    public static function hotelListActive()
    {
        return static::with("name")->where("active","=","1")->orderBy("Id","desc")->get();
    }
//    protected $fillable = ['id','name','city_id','address','active','created_user_id','created_date'];
}
