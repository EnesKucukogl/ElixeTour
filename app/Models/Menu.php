<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    const CREATED_AT = 'created_date';
    const UPDATED_AT  = 'updated_date';

    protected $table = 'vew_menu';


    public function children()
    {
        return $this->hasMany('App\Models\Menu', 'upper_menu_id', 'Id')->where("visible",'=',"1")->orderBy('sort_order');
    }

    public  function textContent()
    {
        return $this->hasMany('App\Models\TranslationView', 'text_content_id', 'menu_name_content_id');
    }

    public  function upperMenuTextContent()
    {
        return $this->hasMany('App\Models\TranslationView', 'text_content_id', 'upper_menu_content_id');
    }

    public static function menuList()
    {
        return static::with("textContent")->with("upperMenuTextContent")->get();
    }

    public static function menuUpperList()
    {
        return static::with("textContent")->where("upper_menu_id","=","0")->get();
    }

}
