<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MajorRequest;
use App\Http\Requests\SchoolYears;
use App\Models\MainCategory;
use App\Models\Major;
use App\Models\Schoolyear;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class SubjectsController extends Controller
{

    public function index()
    {
        $default_lang = get_default_lang();
        $items = Subjects::where('translation_lang', $default_lang)->get();
        $categories = MainCategory::where('translation_lang', $default_lang)->get();
        return view('admin.subjects.index', compact('items', 'categories'));
    }

    public function create()
    {
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        $majors = Major::all()->sortByDesc('id');
        $scYears = Schoolyear::all()->sortByDesc('id');
        return view('admin.subjects.create', compact('categories', 'majors', 'scYears'));
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'subject' => 'required',
                'subject.*.name' => 'required',
                'subject.*.major' => 'required',
                'subject.*.scyear' => 'required',
                'subject.*.semester' => 'required',
                'subject.*.description' => 'required',
                'subject.*.sunday' => 'nullable|string',
                'subject.*.monday' => 'nullable|string',
                'subject.*.tuesday' => 'nullable|string',
                'subject.*.wednesday' => 'nullable|string',
                'subject.*.thursday' => 'nullable|string',
                'subject.*.friday' => 'nullable|string',
                'subject.*.saturday' => 'nullable|string',
                'subject.*.abbr' => 'required',
                'subject.0.active' => 'nullable|integer',
            ];
            $validation = Validator::make($request->all(), $rules);

            if ($validation->fails()){
                return redirect()->route('admin.subjects.create')->with('errors', $validation->errors()->get('*'));
            }

            $main_subjects = collect($request->subject);

            $filter = $main_subjects->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            $default_subject = array_values($filter->all()) [0];

            DB::beginTransaction();

            $active = !empty($default_subject['active']) ? $default_subject['active'] : 0;

            $default_id = Subjects::insertGetId([
                'translation_lang' => $default_subject['abbr'],
                'subject_name'   => $default_subject['name'],
                'subject_major' => $default_subject['major'],
                'subject_year' => $default_subject['scyear'],
                'subject_description' => $default_subject['description'],
                'subject_semester' => $default_subject['semester'],
                'saturday'  => $default_subject['saturday'],
                'sunday'    => $default_subject['sunday'],
                'monday'    => $default_subject['monday'],
                'tuesday'   => $default_subject['tuesday'],
                'wednesday' => $default_subject['wednesday'],
                'thursday'  => $default_subject['thursday'],
                'friday'    => $default_subject['friday'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'active'    => $active,
            ]);

            $subjects = $main_subjects->filter(function ($value, $key) {
                return $value['abbr'] != get_default_lang();
            });


            if (isset($subjects) && $subjects->count()) {

                $subjects_arr = [];
                foreach ($subjects as $subject) {
                    $subjects_arr[] = [
                        'translation_lang'  => $subject['abbr'],
                        'translation_of'    => $default_id,
                        'subject_name'      => $subject['name'],
                        'subject_major' => $subject['major'],
                        'subject_year' => $subject['scyear'],
                        'subject_description' => $subject['description'],
                        'subject_semester' => $subject['semester'],
                        'saturday'  => $subject['saturday'],
                        'sunday'    => $subject['sunday'],
                        'monday'    => $subject['monday'],
                        'tuesday'   => $subject['tuesday'],
                        'wednesday' => $subject['wednesday'],
                        'thursday'  => $subject['thursday'],
                        'friday'    => $subject['friday'],
                        'active'    => $active,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                }

                Subjects::insert($subjects_arr);
            }

            DB::commit();

            return redirect()->route('admin.subjects')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.subjects')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function edit($id)
    {
        //get specific categories and its translations
        $subject = Subjects::where('id', $id)->orWhere('translation_of', $id)->get();
        $categories = MainCategory::where('translation_lang', get_default_lang())
            ->selection()
            ->get();
        $majors = Major::all()->sortByDesc('id');
        $scYears = Schoolyear::all()->sortByDesc('id');

        if (count($subject) === 0)
            return redirect()->route('admin.subjects')->with(['error' => 'هذه الماده غير موجوده']);

        return view('admin.subjects.edit', compact('subject', 'categories', 'majors', 'scYears'));
    }

    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'subject' => 'required',
                'subject.*.name' => 'required',
                'subject.*.major' => 'required',
                'subject.*.scyear' => 'required',
                'subject.*.semester' => 'required',
                'subject.*.description' => 'required',
                'subject.*.sunday' => 'nullable|string',
                'subject.*.monday' => 'nullable|string',
                'subject.*.tuesday' => 'nullable|string',
                'subject.*.wednesday' => 'nullable|string',
                'subject.*.thursday' => 'nullable|string',
                'subject.*.friday' => 'nullable|string',
                'subject.*.saturday' => 'nullable|string',
                'subject.*.abbr' => 'required',
                'subject.0.active' => 'nullable|integer',
            ];
            $validation = Validator::make($request->all(), $rules);

            if ($validation->fails()){
                return redirect()->route('admin.subjects.edit', $id)->with('errors', $validation->messages()->get('*'));
            }

            $main_subjects = collect($request->subject);

            $filter = $main_subjects->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            $default_subject = array_values($filter->all()) [0];

            $active = !empty($default_subject['active']) ? $default_subject['active'] : 0;

            DB::beginTransaction();

            $subjects = Subjects::where('id', $id)->orWhere('translation_of', $id)->get();

            if ($subjects->count() > 0){
                foreach ($subjects as $index => $subject){
                    $subject->subject_name = $request->subject[$index]['name'];
                    $subject->subject_major = $request->subject[$index]['major'];
                    $subject->subject_year = $request->subject[$index]['scyear'];
                    $subject->subject_description = $request->subject[$index]['description'];
                    $subject->subject_semester = $request->subject[$index]['semester'];
                    $subject->subject_semester = $request->subject[$index]['semester'];
                    $subject->saturday = $request->subject[$index]['saturday'];
                    $subject->sunday = $request->subject[$index]['sunday'];
                    $subject->monday = $request->subject[$index]['monday'];
                    $subject->tuesday = $request->subject[$index]['tuesday'];
                    $subject->wednesday = $request->subject[$index]['wednesday'];
                    $subject->thursday = $request->subject[$index]['thursday'];
                    $subject->friday = $request->subject[$index]['friday'];
                    $subject->active = $active;
                    $subject->save();
                }
            } else {
                return redirect()->route('admin.subjects')->with(['error' => 'الماده غير موجوده']);
            }

            DB::commit();

            return redirect()->route('admin.subjects')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.subjects')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($id)
    {
        try{
            $subject = Subjects::find($id);
            if ($subject === false){
                return redirect()->route('admin.subjects')->with(['error' => 'الماده غير موجود']);
            }

            $lectures = $subject->lectureCount();
            if ($lectures->count() > 0) {
                return redirect()->route('admin.subjects')->with(['error' => 'لا يمكن حذف هذه الماده لانها تحتوى على محاضرات']);
            }

            Subjects::where('id', $id)->delete();
            return redirect()->route('admin.subjects')->with(['success' => 'تم حذف الماده بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.subjects')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
