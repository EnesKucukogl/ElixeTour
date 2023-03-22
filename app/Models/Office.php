<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Office extends Model
{
    use HasFactory;


    protected $table = 'vew_office';


    public static function officeList()
    {
        return static::orderBy("Id","desc")->get();
    }

    public static function officeListActive()
    {
        return static::where("active","=",1)->get();
    }

}
