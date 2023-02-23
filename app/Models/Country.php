<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    const CREATED_AT = 'created_date';
    const UPDATED_AT  = 'updated_date';

    protected $table = 'elx_country';

//    protected $fillable = ['id','url','upper_menu_id','menu_name_content_id','visible','created_user_id','updated_user_id'];


}
