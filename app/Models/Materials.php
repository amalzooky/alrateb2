<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    protected $table = 'materials';

    protected $fillable = [
        'translation_lang',
        'translation_of',
        'name_id',
        'name',
        'group_id',
        'major_id',
        'teacher_id',
        'material',
        'active',
        'created_at',
        'updated_at'
    ];


    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeSelection($query)
    {

        return $query->select('id', 'translation_lang',  'name_id',  'teacher_id', 'name',
        'group_id', 'major_id', 'material',
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


    public function matrils()
    {
        return $this->hasMany(self::class, 'translation_of');
    }

    public function major(){
        return $this->hasOne('App\Models\Major','id','major_id');


    }
    public function subject()
    {
        return $this->hasOne('App\Models\Subjects', 'id', 'name_id');
    }

   
    public function teacher(){
        return $this->hasOne('App\Models\Teacher', 'id', 'teacher_id');
    }

  

    
    public function group(){
        return $this->hasOne('App\Models\Groups', 'id', 'group_id');
    }
}

