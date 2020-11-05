<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use Notifiable;

    protected $table = 'vendors';

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
        'fb_parent',
        'expire_date',
        'major',
        'school',
        'student_group',
        'user_type',
        'active',
        'show_notes',
        'notes',
        'created_at',
        'updated_at',
    ];

    protected $hidden = ['password' , 'remember_token'];

    public function subjects()
    {
        return $this->hasMany('App\Models\StudentsSubjects', 'student_id', 'id');
    }

    public function schoolSelected()
    {
        return $this->belongsTo('App\Models\SchoolsItems', 'school_id', 'school');
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
        'fb_parent',
        'expire_date',
        'major',
        'school',
        'student_group',
        'user_type',
        'active',
        'show_notes',
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
