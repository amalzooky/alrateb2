<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slogan extends Model
{
    protected $table = 'slogans';

    protected $fillable = [
        'translation_lang', 'translation_of', 'name','text', 'active', 'photo', 'created_at', 'updated_at'
    ];

   
    public function sloganess()
    {
        return $this->hasMany(self::class, 'translation_of');
    }


    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeSelection($query)
    {

        return $query->select('id',  'translation_lang', 'active', 'translation_of', 'name','text',  'photo');
    }

    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('/' . $val) : "";

    }
    public function getActive()
    {
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';

    }



}

