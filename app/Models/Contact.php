<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    const CREATED_AT = 'created_date';
    const UPDATED_AT  = 'updated_date';

    protected $table = 'elx_contact';

    protected $fillable = ['id','name','surname','e_mail','phone_number','message_content','send_date','status',
                            'created_user_id','updated_user_id','active'];

}
