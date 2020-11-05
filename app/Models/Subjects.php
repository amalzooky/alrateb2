<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $table = 'subjects';

    protected $fillable = [
        'translation_lang',
        'translation_of',
        'subject_name',
        'subject_major',
        'subject_year',
        'subject_semester',
        'subject_description',
        'saturday',
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'active',
        'created_at',
        'updated_at'
    ];

    public function getActive()
    {
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';
    }

    public function majors()
    {
        return $this->hasOne('App\Models\Major', 'id', 'subject_major');
    }

    public function lecture()
    {
        return $this->hasOne('App\Models\Lecture', 'lecture_subject', 'id');
    }

    public function lectureCount()
    {
        return $this->hasMany('App\Models\Lecture', 'lecture_subject', 'id');
    }

    public function scYears()
    {
        return $this->hasOne('App\Models\Schoolyear', 'id', 'subject_year');
    }
}
