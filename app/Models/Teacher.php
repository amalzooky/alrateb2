<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Teacher extends Model
{
    use Notifiable;

    protected $table = 'teacherss';

    protected $fillable = [
        'fullname',
        'username',
        'password',
        'avatar',
        'mobile',
        'telephone_fix',
        'email',
        'city',
        'birthday',
        'gender',
        'fb_student',
        'student_group',
        'sujects',
        'user_type',
        'active',
        'notes',
        'created_at',
        'updated_at',
    ];

    protected $hidden = ['password' , 'remember_token'];

    public function subjects()
    {
        return $this->hasMany('App\Models\StudentsSubjects', 'teacher_id', 'id');
    }

   

    public function groupSelected()
    {
        return $this->belongsTo('App\Models\Groups', 'id', 'student_group');
    }

   public function scopeActive($query)
   {

       return $query->where('active', 1);
   }

//    public function getLogoAttribute($val)
//    {
//        return ($val !== null) ? asset('assets/' . $val) : "";
//
//    }
//

   public function scopeSelection($query)
   {
       return $query->select('id',
       'fullname',
        'username',
        'password',
        'avatar',
        'mobile',
        'telephone_fix',
        'email',
        'city',
        'birthday',
        'gender',
        'fb_student',
        'student_group',
        'sujects',
        'user_type',
        'active',
        'notes');
   }


    public function typeusers()
    {
        return $this->belongsTo('App\Models\TypeUser', 'user_type', 'id');
    }

    public function getActive()
    {
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';

    }


    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }
}
