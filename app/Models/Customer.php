<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    const UPDATED_AT  = 'updated_date';

    protected $table = 'elx_customer';

    protected $fillable = ['id','name','surname','e_mail','password','address','phone_number','date_of_birth','membership_status','registration_date','active','updated_user_id'];
}
