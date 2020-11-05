<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolsItems extends Model
{
    protected $table = 'schools_items';

    public $primaryKey = 'school_id';

    protected $fillable = [
        'translation_lang',
        'translation_of',
        'school_name',
        'created_at',
        'updated_at'
    ];

    public function students(){
        return $this->hasMany('App\Models\Vendor','school','school_id');
    }

}
