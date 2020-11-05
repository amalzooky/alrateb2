<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Lecture;
use App\Models\MainCategory;
use App\Models\Major;
use App\Models\Schoolyear;
use App\Models\Subjects;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Validator;

class LecturesController extends Controller
{
    public function index()
    {
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_lang', get_default_lang())
            ->selection()
            ->get();
        $items = Lecture::where('translation_lang', $default_lang)->get();

        return view('admin.lectures.index', compact('items', 'categories'));
    }

    public function create()
    {
        $categories = MainCategory::where('translation_lang', get_default_lang())
            ->selection()
            ->get();
        $subjects = Subjects::all()->where('translation_lang', get_default_lang())->sortByDesc('id');
        $teachers = Teachers::all()->sortByDesc('id');

        return view('admin.lectures.create', compact('subjects', 'teachers', 'categories'));
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'lecture' => 'required',
                'lecture.*.name' => 'required',
                'lecture.*.description' => 'required',
                'lecture.*.abbr' => 'required',
                'lecture.0.subject' => 'required',
                'lecture.0.teacher' => 'required',
                'lecture.0.active' => 'nullable|integer',
            ];
            $validation = Validator::make($request->all(), $rules);

            if ($validation->fails()){
                return redirect()->route('admin.lectures.create')->with('errors', $validation->errors()->get('*'));
            }

            $main_lectures = collect($request->lecture);

            $filter = $main_lectures->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            $main_lecture = array_values($filter->all()) [0];

            DB::beginTransaction();

            $active = !empty($main_lecture['active']) ? $main_lecture['active'] : 0;

            $default_id = Lecture::insertGetId([
                'translation_lang' => $main_lecture['abbr'],
                'lecture_name'   => $main_lecture['name'],
                'lecture_description' => $main_lecture['description'],
                'lecture_subject' => $main_lecture['subject'],
                'lecture_teacher' => $main_lecture['teacher'],
                'created_at'    => date('Y:m:d H:m:i'),
                'updated_at'   => date('Y:m:d H:m:i'),
                'active'    => $active,
            ]);

            $lectures = $main_lectures->filter(function ($value, $key) {
                return $value['abbr'] != get_default_lang();
            });

            if (isset($lectures) && $lectures->count()) {

                $lectures_arr = [];
                foreach ($lectures as $lecture) {
                    $lectures_arr[] = [
                        'translation_lang'  => $lecture['abbr'],
                        'translation_of'    => $default_id,
                        'lecture_name'      => $lecture['name'],
                        'lecture_description' => $lecture['description'],
                        'lecture_subject' => $main_lecture['subject'],
                        'lecture_teacher' => $main_lecture['teacher'],
                        'active'    => $active,
                    ];
                }

                Lecture::insert($lectures_arr);
            }

            DB::commit();

            return redirect()->route('admin.lectures')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.lectures')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function edit($id)
    {
        $lectures = Lecture::where('id', $id)->orWhere('translation_of', $id)->get();
        $categories = MainCategory::where('translation_lang', get_default_lang())
            ->selection()
            ->get();
        $subjects = Subjects::all()->where('translation_lang', get_default_lang())->sortByDesc('id');
        $teachers = Teachers::all()->sortByDesc('id');

        if (count($lectures) === 0)
            return redirect()->route('admin.lectures')->with(['error' => 'هذه المحاضره غير موجوده']);

        return view('admin.lectures.edit', compact('lectures', 'categories', 'subjects', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'lecture' => 'required',
                'lecture.*.name' => 'required',
                'lecture.*.description' => 'required',
                'lecture.*.abbr' => 'required',
                'lecture.0.subject' => 'required',
                'lecture.0.teacher' => 'required',
                'lecture.0.active' => 'nullable|integer',
            ];
            $validation = Validator::make($request->all(), $rules);

            if ($validation->fails()){
                return redirect()->route('admin.lectures.edit', $id)->with('errors', $validation->errors()->get('*'));
            }

            $main_lectures = collect($request->lecture);

            $filter = $main_lectures->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            $main_lecture = array_values($filter->all()) [0];

            $active = !empty($main_lecture['active']) ? $main_lecture['active'] : 0;

            DB::beginTransaction();

            $lectures = Lecture::where('id', $id)->orWhere('translation_of', $id)->get();

            if ($lectures->count() > 0){
                foreach ($lectures as $index => $lecture){
                    $lecture->lecture_name = $request->lecture[$index]['name'];
                    $lecture->lecture_description = $request->lecture[$index]['description'];
                    $lecture->lecture_subject = $request->lecture[0]['subject'];
                    $lecture->lecture_teacher = $request->lecture[0]['teacher'];
                    $lecture->active = $active;
                    $lecture->save();
                }
            } else {
                return redirect()->route('admin.lectures')->with(['error' => 'المحاضره غير موجوده']);
            }

            DB::commit();

            return redirect()->route('admin.lectures')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.lectures')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($id)
    {
        try{
            $lecture = Lecture::find($id);
            if ($lecture === false){
                return redirect()->route('admin.lectures')->with(['error' => 'المحاضره غير موجوده']);
            }

            Lecture::where('id', $id)->delete();
            return redirect()->route('admin.lectures')->with(['success' => 'تم حذف المحاضره بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.lectures')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
