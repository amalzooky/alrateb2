<?php

namespace App\Models;

use App\Observers\MainCategoryObserver;
use Illuminate\Database\Eloquent\Model;

class School extends Model
  {
    protected $table = 'schools';

    protected $fillable = [
        'name', 'address', 'active', 'created_at', 'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();
        MainCategory::observe(MainCategoryObserver::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeSelection($query)
    {

        return $query->select('id', 'name', 'years', 'active', 'created_at', 'updated_at');
    }

    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('/' . $val) : "";

    }

    public function getActive()
    {
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';

    }


    public function categories()
    {
        return $this->hasMany(self::class, 'translation_of');
    }


    public function vendors(){

        return $this -> hasMany('App\Models\Vendor','category_id','id');
    }



}
