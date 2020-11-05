<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolYears;
use App\Http\Requests\TypeUsersRequest;
use App\Models\MainCategory;
use App\Models\Schoolyear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Validator;

class SchoolyearsController extends Controller
{
    public function index()
    {
        $default_lang = get_default_lang();
        $school_years = Schoolyear::where('translation_lang', $default_lang)
            ->selection()
            ->get()->sortByDesc('id');
        $categories = MainCategory::all();

//        echo '<pre>';
//            var_dump($school_years);
//        echo '</pre>';
//        exit;

        return view('admin.schoolyears.index', compact('school_years' ,'categories'));
    }

    public function create()
    {
        $categories = MainCategory::all();

        return view('admin.schoolyears.create' , compact('categories'));

    }


    public function store(Request $request)
    {
        $rules = [
            'schoolyear.*.name'     => 'required',
            'schoolyear.*.years'    => 'required',
            'schoolyear.*.abbr'     => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return redirect()->route('admin.schoolyears.create')->with('errors', $validator->messages()->get('*'));
        }

        try{
            $main_schoolyrs = collect($request->schoolyear);

            $filter = $main_schoolyrs->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });
// save defulte lang in data base-------------///
            $default_schoolyrs = array_values($filter->all()) [0];

                DB::beginTransaction();


// save another lange--------//

            if (!$request->has('schoolyear.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            $default_schoolyrs_id = Schoolyear::insertGetId([
                'translation_lang' => $default_schoolyrs['abbr'],
                'name'      => $default_schoolyrs['name'],
                'years'     => $default_schoolyrs['years'],
                'active'    => $request->active,
                'created_at' => date('Y:m:d H:i:s'),
                'updated_at' => date('Y:m:d H:i:s'),
            ]);

            $schoolyears = $main_schoolyrs->filter(function ($value, $key) {
                return $value['abbr'] !== get_default_lang();
            });


            if (isset($schoolyears) && $schoolyears->count()) {

                $schoolyears_arr = [];
                foreach ($schoolyears as $schoolyear) {
                    $schoolyears_arr[] = [
                        'translation_lang'  => $schoolyear['abbr'],
                        'translation_of'    => $default_schoolyrs_id,
                        'name'      => $schoolyear['name'],
                        'years'     => $schoolyear['years'],
                        'active'    => $request->active,
                        'created_at' => date('Y:m:d H:i:s'),
                        'updated_at' => date('Y:m:d H:i:s'),
                    ];
                }

                Schoolyear::insert($schoolyears_arr);
            }

            DB::commit();

            return redirect()->route('admin.schoolyears')->with(['success' => 'تم الحفظ بنجاح']);
        }
        catch (\Exception $ex){
            DB::rollback();
            return redirect()->route('admin.schoolyears')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

///-------------edite------------//
    public function edit($id)
    {
        //get specific categories and its translations
        $schoolYear = Schoolyear::where('id', $id)->orWhere('translation_of', $id)->get();
        if (count($schoolYear) === 0)
            return redirect()->route('admin.schoolyears')->with(['error' => 'هذه السنه غير موجوده ']);
        $categories = MainCategory::all();

        return view('admin.schoolyears.edit', compact('schoolYear' ,'categories'));
    }


    public function update($schyears_id, Request $request)
    {

        $rules = [
            'schoolyear.*.name'     => 'required',
            'schoolyear.*.years'    => 'required',
            'schoolyear.*.abbr'     => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return redirect()->route('admin.schoolyears.edit', $schyears_id)->with('errors', $validator->messages()->get('*'));
        }

        try {
            $schoolYear = Schoolyear::find($schyears_id);

            if (!$schoolYear)
                return redirect()->route('admin.schoolyears')->with(['error' => 'هذا القسم غير موجود ']);

            // update date

            $schoolyear = array_values($request->schoolyear) [0];

            if (!$request->has('schoolyear.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);


            Schoolyear::where('id', $schyears_id)
                ->update([
                    'name' => $schoolyear['name'],
                    'years' => $schoolyear['years'],
                    'active' => $request->active,
                ]);

            return redirect()->route('admin.schoolyears')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.schoolyears')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function destroy($id)
    {

        try {
            $schoolyears = Schoolyear::find($id);
            if (!$schoolyears)
                return redirect()->route('admin.schoolyears')->with(['error' => 'هذه السنه غير موجود ']);

            $vendors = $schoolyears->vendors();
            $subjects = $schoolyears->subjects();

            if ($vendors->count() > 0 || $subjects->count() > 0) {
                return redirect()->route('admin.schoolyears')->with(['error' => 'لأ يمكن حذف هذه السنه  ']);
            }

            $schoolyears->delete();
            return redirect()->route('admin.schoolyears')->with(['success' => 'تم حذف السنه بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.schoolyears')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
