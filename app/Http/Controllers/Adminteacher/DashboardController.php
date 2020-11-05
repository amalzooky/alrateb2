<?php

namespace App\Http\Controllers\Adminteacher;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\SchoolsItems;
use App\Models\Teacheres;
use App\Models\Teachers;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        // $student = Student::where('id', 'guest:student'->id);
        $teacher = Teachers::all();


        return view('teacher.dashboard', compact('teacher'));
    }

    public function sidebar()
    {
        $teacher = Teachers::all();
        return view('teacher.includes.header', compact('teacher'));

    }

    public function profile()
    {
        $id = \Auth::guard('teacher')->user()->id;
        $teacher = Teachers::all()->where('id', $id)->first();
        $school = DB::table('schools_items')->select('school_name')
            ->where('school_id', $teacher->school)
            ->orWhere('translation_of', $teacher->school)->first();
        $major = DB::table('majors')->select('major_name')
            ->where('id', $teacher->major)
            ->orWhere('translation_of', $teacher->major)->first();
        $group = DB::table('groups')->select('name')
            ->where('id', $teacher->student_group)
            ->orWhere('translation_of', $teacher->student_group)->first();


        // to get student subjects you can get it with this {$vendor->subjects} this is array have objects
        // to get student school you can get it with this {$school} this is single object {can be empty}
        // to get student major you can get it with this {$major} this is single object

        return view('teacher.profile', compact('teacher', 'school', 'major' ,'group'));
    }

    public function lacture()
    {

        $id = \Auth::guard('teacher')->user()->id;
        $vendor = Vendor::all()->where('id', $id)->first();
        $school = DB::table('schools_items')->select('school_name')
            ->where('school_id', $vendor->school)
            ->orWhere('translation_of', $vendor->school)->first();
        $major = DB::table('majors')->select('major_name')
            ->where('id', $vendor->major)
            ->orWhere('translation_of', $vendor->major)->first();
     $subjects = DB::table('subjects')->select('subject_name')->first();
    

         
         return view('teacher.pages.lactures', compact('vendor', 'school', 'major' ,'subjects' ));

    }

    public function acount()
    {
        $id = \Auth::guard('teacher')->user()->id;
        $vendor = Vendor::all()->where('id', $id)->first();
        $school = DB::table('schools_items')->select('school_name')
            ->where('school_id', $vendor->school)
            ->orWhere('translation_of', $vendor->school)->first();
        $major = DB::table('majors')->select('major_name')
            ->where('id', $vendor->major)
            ->orWhere('translation_of', $vendor->major)->first();   
         $subject = DB::table('subjects')->select('subject_name')
            ->where('id', $vendor->id)
            ->orWhere('translation_of', $vendor->id)->first();    
            
        return view('teacher.pages.acount', compact('vendor', 'school', 'major' ,'subject'));

    }

    public function groups()
    {
        $id = \Auth::guard('teacher')->user()->id;
        $vendor = Vendor::all()->where('id', $id)->first();
        $school = DB::table('schools_items')->select('school_name')
            ->where('school_id', $vendor->school)
            ->orWhere('translation_of', $vendor->school)->first();
        $major = DB::table('majors')->select('major_name')
            ->where('id', $vendor->major)
            ->orWhere('translation_of', $vendor->major)->first();
        $group = DB::table('groups')->select('name')
            ->where('id', $vendor->student_group)
            ->orWhere('translation_of', $vendor->student_group)->first();

        return view('teacher.pages.groups', compact('vendor', 'school', 'major' ,'group'));

    }

    public function teachers()
    {
        $vendors = Vendor::all();
        return view('teacher.pages.teachers', compact('vendors'));

    }


}

