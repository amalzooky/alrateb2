<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MajorRequest;
use App\Models\MainCategory;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class MajorsController extends Controller
{

    public function index()
    {
        $default_lang = get_default_lang();
        $items = Major::where('translation_lang', $default_lang)->get();
        $categories = MainCategory::where('translation_lang', $default_lang)->get();
        return view('admin.majors.index', compact('items', 'categories'));
    }

    public function create()
    {
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        return view('admin.majors.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'major.*.name' => 'required',
                'major.*.active' => 'nullable|integer',
                'major.*.abbr' => 'required',
                'major.*.image'  => 'nullable|image',
            ];
            $validation = Validator::make($request->all(), $rules);

            if ($validation->fails()){
                return redirect()->route('admin.majors.create')->with('errors', $validation->messages()->get('*'));
            }

            $main_majors = collect($request->major);

            $filter = $main_majors->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            $default_major = array_values($filter->all()) [0];

            DB::beginTransaction();

            // save image

            if ($request->hasFile('major.*.image')) {
                $file = $request->file('major.*.image')[0];
                $filePath = uploadImage('major', $file);
            } else {
                $filePath = null;
            }

            $active = !empty($default_major['active']) ? $default_major['active'] : 0;

            $default_id = Major::insertGetId([
                'translation_lang' => $default_major['abbr'],
                'major_name'   => $default_major['name'],
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
                'active'       => $active,
            ]);

            if ($filePath !== null){
                Major::where('id', $default_id)
                    ->update([
                        'major_image' => $filePath,
                    ]);
            }

            $majors = $main_majors->filter(function ($value, $key) {
                return $value['abbr'] != get_default_lang();
            });


            if (isset($majors) && $majors->count()) {

                $majors_arr = [];
                foreach ($majors as $major) {
                    $majors_arr[] = [
                        'translation_lang' => $major['abbr'],
                        'translation_of' => $default_id,
                        'major_name'   => $major['name'],
                        'major_image'   => $filePath,
                        'active'       => $active,
                        'created_at'   => date('Y-m-d H:i:s'),
                        'updated_at'   => date('Y-m-d H:i:s'),
                    ];
                }

                Major::insert($majors_arr);
            }

            DB::commit();

            return redirect()->route('admin.majors')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.majors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function edit($id)
    {
        //get specific categories and its translations
        $major = Major::where('id', $id)->orWhere('translation_of', $id)->get();
        $categories = MainCategory::where('translation_lang', get_default_lang())
            ->selection()
            ->get();

        if (count($major) === 0)
            return redirect()->route('admin.majors')->with(['error' => 'هذا التخصص غير موجود ']);

        return view('admin.majors.edit', compact('major', 'categories'));
    }

    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'major.*.name' => 'required',
                'major.*.active' => 'nullable|integer',
                'major.*.abbr' => 'required',
                'major.*.image'  => 'nullable|image',
            ];
            $validation = Validator::make($request->all(), $rules);

            if ($validation->fails()){
                return redirect()->route('admin.majors.edit', $id)->with('errors', $validation->messages()->get('*'));
            }

            $main_majors = collect($request->major);

            $filter = $main_majors->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            $default_major = array_values($filter->all()) [0];

            $active = !empty($default_major['active']) ? $default_major['active'] : 0;

            DB::beginTransaction();

            $major = Major::where('id', $id)->orWhere('translation_of', $id)->get();

            // save image
            if ($request->hasFile('major.*.image')) {
                $file = $request->file('major.*.image')[0];
                $filePath = uploadImage('major', $file);
                !empty($major[0]->major_image) && file_exists($major[0]->major_image) ? unlink($major[0]->major_image) : null;
            } else {
                $filePath = $major[0]->major_image;
            }


            if ($major->count() > 0){
                foreach ($major as $index => $item){
                    $item->major_name = $request->major[$index]['name'];
                    $item->major_image = $filePath;
                    $item->active = $active;
                    $item->save();
                }
            } else {
                return redirect()->route('admin.majors')->with(['error' => 'التخصص غير موجود']);
            }

            DB::commit();

            return redirect()->route('admin.majors')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.majors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($id)
    {
        try{
            $major = Major::find($id);
            if ($major === false){
                return redirect()->route('admin.majors')->with(['error' => 'التخصص غير موجود']);
            }

            $subjects = $major->subjects();
            $students = $major->students();

            if ($subjects->count() > 0 || $students->count() > 0) {
                return redirect()->route('admin.majors')->with(['error' => 'لايمكن حذف هذا التخصص لانه يحتوى على مواد او طلاب']);
            }

            $fileName = $major->major_image;
            if (Major::where('id', $major->id)->delete())
                !empty($fileName) && file_exists($fileName) ? unlink($fileName) : null;
            return redirect()->route('admin.majors')->with(['success' => 'تم حذف التخصص بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.majors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
