<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    const CREATED_AT = 'created_date';
    const UPDATED_AT  = 'updated_date';

    protected $table = 'elx_language';

    protected $fillable = ['id','name','symbol','created_user_id','updated_user_id','active'];

}
