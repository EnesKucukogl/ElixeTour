<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    use HasFactory;

    const CREATED_AT = 'created_date';
    const UPDATED_AT  = 'updated_date';

    protected $table = 'elx_accomodation';

    protected $fillable = ['id', 'room_type', 'hotel_id', 'active', 'created_user_id','updated_user_id'];


}
