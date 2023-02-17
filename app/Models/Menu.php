<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'elx_menu';

    //protected $fillable = ['name', 'upper_menu_id', 'menu_name_content_id','visible'];
}
