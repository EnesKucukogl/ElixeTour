<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Cviebrock\EloquentSluggable\Sluggable;

class Questions extends Model
{
    use HasFactory;

    protected $table = 'vew_questions';

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
//    public function sluggable(): array
//    {
//        return [
//            'slug' => [
//                'source' => 'title'
//            ]
//        ];
//    }

    public  function questionTextContent()
    {
        return $this->hasMany('App\Models\TranslationView', 'text_content_id', 'question_content_id');
    }

    public  function answerTextContent()
    {
        return $this->hasMany('App\Models\TranslationView', 'text_content_id', 'answer_content_id');
    }


    public static function questionsList()
    {
        return static::with("questionTextContent")->with("answerTextContent")->orderBy("Id","desc")->get();
    }

    public static function questionsListActive()
    {
        return static::with("questionTextContent")->with("answerTextContent")->where("active","=","1")->orderBy("sort_order","asc")->get();
    }

    public static function questionsListSlug($slug)
    {
        return static::with("questionTextContent")->with("answerTextContent")->where("active","=","1")->where("slug","=",$slug)->orderBy("sort_order","asc")->get();
    }

//    public static function packageName()
//    {
//        return static::hasMany('App\Models\Package','package_id','Id');
//    }

}
