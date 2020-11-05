<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsSubjects extends Model
{
    protected $table = 'student_subjects';

    protected $fillable = [
        'subject_id',
        'student_id',
        'teacher_id',
        'subject_price',
        'subject_tax',
        'subject_discount',
    ];

    public $timestamps = false;
}
