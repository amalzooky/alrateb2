<?php

namespace App\Models;

use App\Observers\MainCategoryObserver;
use Illuminate\Database\Eloquent\Model;
use App\Models\Language;
class TypeUser extends Model
{
    protected $table = 'type_users';

    protected $fillable = [
        'translation_lang', 'translation_of', 'name',  'photo', 'active', 'created_at', 'updated_at'
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

        return $query->select('id', 'translation_lang', 'name',  'photo', 'active', 'translation_of');
    }

    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('/' . $val) : "";

    }

    public function getActive()
    {
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';

    }


    public function type_User()
    {
        return $this->hasMany(self::class, 'translation_of');
    }


    public function vendors(){

        return $this -> hasMany('App\Models\Vendor','category_id','id');
    }

}
