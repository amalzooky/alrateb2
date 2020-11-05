<?php

namespace App\Models;

use App\Observers\MainCategoryObserver;
use Illuminate\Database\Eloquent\Model;

class Schoolyear extends Model
{
    protected $table = 'schoolyears';

    protected $fillable = [
        'name', 'years', 'created_at', 'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();
        MainCategory::observe(MainCategoryObserver::class);
    }

//    public function scopeActive($query)
//    {
//        return $query->where('active', 1);
//    }

    public function scopeSelection($query)
    {

        return $query->select('id', 'name', 'years', 'active','translation_of', 'translation_lang', 'created_at', 'updated_at');
    }


    public function getActive()
    {
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';

    }


    public function schoolYears()
    {
        return $this->hasMany(self::class, 'translation_of');
    }

    public function subjects(){
        return $this -> hasMany('App\Models\Subjects','subject_year','id');
    }

    public function vendors(){
        return $this -> hasMany('App\Models\Vendor','category_id','id');
    }

}
