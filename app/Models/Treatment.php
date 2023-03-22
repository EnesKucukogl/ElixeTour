<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Treatment extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'vew_treatment';

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

    public function treatmentTextContent()
    {
        return $this->hasMany('App\Models\TranslationView', 'text_content_id', 'treatment_name_content_id');
    }

    public function descriptionTextContent()
    {
        return $this->hasMany('App\Models\TranslationView', 'text_content_id', 'description_content_id');
    }

    public function packageTreatment()
    {
        return $this->hasMany('App\Models\PackageTreatment', 'treatment_id', 'Id');
    }

    public static function treatmentList()
    {
        return static::with("treatmentTextContent")->with("descriptionTextContent")->orderBy("Id", "desc")->get();
    }

    public static function treatmentListActive()
    {
        return static::with("treatmentTextContent")->with("descriptionTextContent")->where("active", "=", "1")->orderBy("Id", "desc")->get();
    }

    public static function treatmentRandomListActive()
    {
        return static::with("treatmentTextContent")->with("descriptionTextContent")->where("active", "=", "1")->where("highlighted","=","1")->inRandomOrder()->take(4)->get();
    }

    public static function treatmentSingleSlug($slug)
    {
        return static::with("treatmentTextContent")->with("descriptionTextContent")->where("slug", "=", $slug)->first();
    }


    public static function packageTreatmentList($package_Id)
    {
        return static::whereHas('packageTreatment', function ($query) use ($package_Id) {
            $query->where('package_id', $package_Id);
        })->with("treatmentTextContent")->with("descriptionTextContent")->where("active", "=", "1")->orderBy("Id", "desc")->get();
    }


}
