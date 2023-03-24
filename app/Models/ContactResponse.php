<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactResponse extends Model
{
    use HasFactory;

    protected $table = 'elx_contact_response';

    public function BondWithContact()
    {
        return $this->hasOne('App\Models\Contact', 'Id', 'contact_id');
    }

    public static function listAll($contact_id)
    {
        return static::with("BondWithContact")->where("contact_id","=",$contact_id)->orderBy("Id", "desc")->get();
    }
}
