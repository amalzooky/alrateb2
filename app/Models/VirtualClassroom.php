<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VirtualClassroom extends Model
{
    protected $table = 'virtualclass';

    protected $fillable = [

        'title',
        'subject_id',
        'group_id',
        'join_url',
        'user_id',
        'start_time',
        'class_id',
        'recording_url',
        'presenter_url',
        'webinar_url',
        'webinar_description',
        'webinar_end_time',
        'created_at',
        'updated_at'
    ];





    public function scopeSelection($query)
    {

        return $query->select('id', 'title', 'subject_id', 'group_id',  'start_time', 'created_at', 'updated_at');
    }






    public function vendors(){

        return $this -> hasMany('App\Models\Vendor','category_id','id');
    }

}

