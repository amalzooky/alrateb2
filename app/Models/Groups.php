<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'translation_lang',
        'translation_of',
        'name',
        'photo',
        'active',
        'created_at',
        'updated_at'
    ];
    // protected static function boot()
    // {
    //     parent::boot();
    //     MainCategory::observe(MainCategoryObserver::class);
    // }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeSelection($query)
    {

        return $query->select('id', 'translation_lang',  'name',
        'photo',
        'active', 'translation_of');
    }

    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('/' . $val) : "";

    }

    public function getActive()
    {
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';

    }


    public function groupes()
    {
        return $this->hasMany(self::class, 'translation_of');
    }

    public function students(){
        return $this->hasMany('App\Models\Vendor','student_group','id');


    }
    public function vendors(){

        return $this -> hasMany('App\Models\Vendor','category_id','id');
    }

}



    