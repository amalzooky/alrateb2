<?php

namespace App\Http\Controllers\Adminstudent;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\SchoolsItems;
use App\Models\Vendor;
use App\Models\Teachers;
use App\Models\Subjects;



use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        // $student = Student::where('id', 'guest:student'->id);
        $vendors = Vendor::all();


        return view('student.dashboard', compact('vendors'));
    }

    public function sidebar()
    {
        $vendors = Vendor::all();
        return view('student.includes.header', compact('vendors'));

    }

    public function profile()
    {
        $id = \Auth::guard('student')->user()->id;
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


        // to get student subjects you can get it with this {$vendor->subjects} this is array have objects
        // to get student school you can get it with this {$school} this is single object {can be empty}
        // to get student major you can get it with this {$major} this is single object

        return view('student.profile', compact('vendor', 'school', 'major' ,'group'));
    }

    public function lacture()
    {

        $id = \Auth::guard('student')->user()->id;
        $vendor = Vendor::all()->where('id', $id)->first();
        $school = DB::table('schools_items')->select('school_name')
            ->where('school_id', $vendor->school)
            ->orWhere('translation_of', $vendor->school)->first();
        $major = DB::table('majors')->select('major_name')
            ->where('id', $vendor->major)
            ->orWhere('translation_of', $vendor->major)->first();

        $subjects = DB::table('student_subjects')
            ->select('student_subjects.*', 'subjects.*', 'teacherss.*', 'materials.*')
            ->join('subjects', 'subjects.id', '=', 'student_subjects.subject_id')
            ->join('teacherss', 'student_subjects.teacher_id', '=', 'teacherss.id')
            ->leftJoin('materials', 'materials.teacher_id', '=', 'teacherss.id')
            ->where('student_subjects.student_id', '=', \Auth::guard('student')->user()->id)
            ->groupBy(['student_subjects.id'])->get();

        echo '<pre>';
            var_dump($subjects);
        echo '</pre>';
        exit;

        return view('student.pages.lactures', compact('vendor', 'school', 'major' ,'subjects' ));

    }

    public function acount()
    {
        $id = \Auth::guard('student')->user()->id;
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

        return view('student.pages.acount', compact('vendor', 'school', 'major' ,'subject'));

    }

    public function groups()
    {
        $id = \Auth::guard('student')->user()->id;
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

        return view('student.pages.groups', compact('vendor', 'school', 'major' ,'group'));

    }

    public function classes()
    {
        $id = \Auth::guard('student')->user()->id;
        $vendor = Vendor::all()->where('id', $id)->first();
        $school = DB::table('schools_items')->select('school_name')
            ->where('school_id', $vendor->school)
            ->orWhere('translation_of', $vendor->school)->first();
        $major = DB::table('majors')->select('major_name')
            ->where('id', $vendor->major)
            ->orWhere('translation_of', $vendor->major)->first();
//        $classes = DB::table('student_class')
//            ->select('student_class.*',
//                'virtualclass.subject_id',
//                'virtualclass.title',
//                'virtualclass.start_time',
//                'student_subjects.id',
//                'subjects.subject_name')
//            ->join('virtualclass', 'virtualclass.id', '=', 'student_class.virtual_classroom_id')
//            ->join('student_subjects', 'student_subjects.student_id', '=', 'virtualclass.subject_id')
//            ->join('subjects', 'virtualclass.subject_id', '=', 'subjects.id')
//            ->where('student_subjects.student_id', $id)
////            ->where('student_class.student_id', $id)
//            ->orWhere('student_class', $id)
//            ->get();
//        $classes = DB::table('student_subjects')
//            ->select('student_subjects.id',
//                    'virtualclass.subject_id',
//                    'virtualclass.title',
//                    'virtualclass.start_time',
//                    'virtualclass.webinar_end_time',
//                    'virtualclass.webinar_url',
//                    'student_class.url',
//                    'student_class.student_id')
//            ->join('virtualclass', 'virtualclass.subject_id', '=', 'student_subjects.subject_id')
//            ->leftJoin('student_class', 'student_class.student_id', '=', 'student_subjects.student_id')
//            ->where('student_subjects.student_id', $id)
////            ->where('virtualclass.webinar_url', '!=', NULL)
//            ->get()->sortByDesc('virtualclass.id');

        $classes = DB::table('virtualclass')
            ->select('student_subjects.id',
                    'subjects.subject_name',
                    'virtualclass.subject_id',
                    'virtualclass.title',
                    'virtualclass.start_time',
                    'virtualclass.webinar_end_time',
                    'virtualclass.webinar_url',
                    'virtualclass.join_url',
                    'student_class.url',
                    'student_class.student_id')
            ->join('student_subjects', 'virtualclass.subject_id', '=', 'student_subjects.subject_id')
            ->join('subjects', 'virtualclass.subject_id', '=', 'subjects.id')
            ->leftJoin('student_class', 'virtualclass.id', '=', 'student_class.virtual_classroom_id')
            ->where('student_subjects.student_id', $id)
            ->whereRaw("student_class.student_id = $id OR student_class.student_id IS NULL")
            ->groupBy(['virtualclass.id'])
            ->orderByDesc('virtualclass.id')
            ->get();

//        echo '<pre>';
//            var_dump($classes);
//        echo '</pre>';
//        exit;

        return view('student.pages.classes', compact('vendor', 'school', 'major' ,'classes'));

    }

    public function teachers()
    {
        $vendors = Vendor::all();
        return view('student.pages.teachers', compact('vendors'));

    }


}

