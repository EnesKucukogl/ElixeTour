<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'elx_user';

    const CREATED_AT = 'created_date';
    const UPDATED_AT  = 'updated_date';

    protected $fillable = ['id','name','surname','user_name','password','active','create_user_id','created_date','update_user_id','updated_date','active'];
}
