<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;


    protected $table = 'elx_menu';

    protected $fillable = ['Id','url','upper_menu_id','menu_name_content_id','visible','created_user_id','updated_user_id'];


    public function children()
    {
        return $this->hasMany('App\Models\Menu', 'upper_menu_id', 'Id')->where("visible",'=',"1")->orderBy('sort_order');
    }

    public function textContent()
    {
        return $this->hasMany('App\Models\TranslationView', 'text_content_id', 'menu_name_content_id');
    }


}
