<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Blog extends Model
{

    use HasFactory,Sluggable;

    //const CREATED_AT = 'created_date';
    //const UPDATED_AT  = 'updated_date';

    protected $table = 'vew_blog';

//    protected $fillable = ['id','slug','title_content_id','short_description_content_id','description_content_id','active','created_user_id','created_date','created_user_name','updated_user_id','updated_date','updated_user_name'];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public  function TitleTextContent()
    {
        return $this->hasMany('App\Models\TranslationView', 'text_content_id', 'title_content_id');
    }

    public  function ShortDescriptionTextContent()
    {
        return $this->hasMany('App\Models\TranslationView', 'text_content_id', 'short_description_content_id');
    }

    public  function DescriptionTextContent()
    {
        return $this->hasMany('App\Models\TranslationView', 'text_content_id', 'description_content_id');
    }

    public static function BlogList()
    {
        return static::with("TitleTextContent")->with("ShortDescriptionTextContent")->with("DescriptionTextContent")->get();
    }

    public static function BlogSingleSlug($slug)
    {
        return static::with("TitleTextContent")->with("ShortDescriptionTextContent")->with("DescriptionTextContent")->where("slug", "=", $slug)->first();
    }

    public static function BlogListActive()
    {
        return static::with("TitleTextContent")->with("ShortDescriptionTextContent")->with("DescriptionTextContent")->where("active", "=", "1")->orderBy("Id", "desc")->get();
    }

}
