<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $table = 'lectures';

    protected $fillable = [
        'translation_lang',
        'translation_of',
        'lecture_name',
        'lecture_description',
        'lecture_subject',
        'lecture_teacher',
        'active',
        'created_at',
        'updated_at'
    ];

    public function getActive(){
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';
    }

    public function subject(){
        return $this->hasOne('App\Models\Subjects', 'id', 'lecture_subject');
    }

    public function teacher(){
        return $this->hasOne('App\Models\Teacher', 'id', 'lecture_teacher');
    }

}
