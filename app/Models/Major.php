<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $table = 'majors';

    protected $fillable = [
        'translation_lang',
        'translation_of',
        'major_name',
        'major_image',
        'active',
        'created_at',
        'updated_at'
    ];

    public function getActive()
    {
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';

    }

    public function schoolYears()
    {
        return $this->hasMany(self::class, 'translation_of');
    }

    public function subjects(){
        return $this->hasMany('App\Models\Subjects','subject_major','id');
    }

    public function students(){
        return $this->hasMany('App\Models\Vendor','major','id');
    }

}
