<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\SchoolsItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class SchoolsItemsController extends Controller
{

    public function index()
    {
        $default_lang = get_default_lang();
        $items = SchoolsItems::where('translation_lang', $default_lang)->get()->sortByDesc('school_id');
        $categories = MainCategory::where('translation_lang', $default_lang)->get();
        return view('admin.schoolsitems.index', compact('items', 'categories'));
    }

    public function create()
    {
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        return view('admin.schoolsitems.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'school' => 'required|array|min:1',
            'school.*.name' => 'required',
            'school.*.abbr' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->route('admin.schoolsitems.create')->with('errors', $validator->messages()->get('*'));
        }

        try {
            $main_schools = collect($request->school);

            $filter = $main_schools->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            $default_school = array_values($filter->all()) [0];

            DB::beginTransaction();

            $default_school_id = SchoolsItems::insertGetId([
                'translation_lang' => $default_school['abbr'],
                'school_name'   => $default_school['name'],
                'created_at'    => date('Y:m:d H:m:i'),
                'updated_at'   => date('Y:m:d H:m:i'),
            ]);

            $schools = $main_schools->filter(function ($value, $key) {
                return $value['abbr'] != get_default_lang();
            });


            if (isset($schools) && $schools->count()) {

                $schools_arr = [];
                foreach ($schools as $school) {
                    $schools_arr[] = [
                        'translation_lang' => $school['abbr'],
                        'translation_of' => $default_school_id,
                        'school_name'   => $school['name'],
                        'created_at'    => date('Y:m:d H:m:i'),
                        'updated_at'   => date('Y:m:d H:m:i'),
                    ];
                }

                SchoolsItems::insert($schools_arr);
            }

            DB::commit();

            return redirect()->route('admin.schoolsitems')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.schoolsitems')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function edit($id)
    {
        //get specific categories and its translations
        $school = SchoolsItems::where('school_id', $id)->orWhere('translation_of', $id)->get();
        $categories = MainCategory::where('translation_lang', get_default_lang())
            ->selection()
            ->get();

        if (count($school) === 0)
            return redirect()->route('admin.schoolsitems')->with(['error' => 'هذه المدرسه غير موجود ']);

        return view('admin.schoolsitems.edit', compact('school', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'school' => 'required|array|min:1',
            'school.*.name' => 'required',
            'school.*.abbr' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->route('admin.schoolsitems')->with(['errors' => $validator->messages]);
        }

        try {

            DB::beginTransaction();

            $school = SchoolsItems::where('school_id', $id)->orWhere('translation_of', $id)->get();

            if ($school->count() > 0){
                foreach ($school as $index => $item){
                    $item->school_name = $request->school[$index]['name'];
                    $item->save();
                }
            } else {
                return redirect()->route('admin.schoolsitems')->with(['error' => 'المدرسه غير موجوده']);
            }

            DB::commit();

            return redirect()->route('admin.schoolsitems')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.schoolsitems')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($id)
    {
        try{
            $school = SchoolsItems::find($id);
            if ($school === false){
                return redirect()->route('admin.schoolsitems')->with(['error' => 'المدرسه غير موجوده']);
            }

            $schoolToDelete = SchoolsItems::find($id);
            $students = $schoolToDelete->students;
            if ($students->count() > 0){
                return redirect()->route('admin.schoolsitems')->with(['error' => 'لايمكن حذف المدرسه لانها تحتوى على طلاب']);
            }
            $schoolToDelete->delete();
            return redirect()->route('admin.schoolsitems')->with(['success' => 'تم حذف المدرسه بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.schoolsitems')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
