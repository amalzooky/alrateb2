<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    protected $table = 'student_class';

    protected $fillable = [
        'virtual_classroom_id', 'url', 'student_id'
    ];

    public function virtualClass()
    {
        return $this->hasOne('App\Models\VirtualClassroom', 'id', 'virtual_classroom_id');
    }

    public function student()
    {
        return $this->hasOne('App\Models\Student', 'id', 'student_id');
    }
}
