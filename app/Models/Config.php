<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $table = 'elx_config';

    const CREATED_AT = 'created_date';
    const UPDATED_AT  = 'updated_date';

    protected $fillable = ['id','telephone','mail','create_user_id'];
}
