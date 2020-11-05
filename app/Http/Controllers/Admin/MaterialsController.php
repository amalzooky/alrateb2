<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MaterialsRequest;
use App\Models\MainCategory;
use App\Models\Groups;
use App\Models\Major;
use App\Models\Materials;
use App\Models\Teacher;
use App\Models\Subjects;
use DB;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
class MaterialsController extends Controller
{
    public function index()
    {
        $default_lang = get_default_lang();
        $matirails = Materials::where('translation_lang', $default_lang)
            ->selection()
            ->get();
            $categories = MainCategory::where('translation_lang', $default_lang)->get();


        return view('admin.materials.index', compact('matirails' ,'categories'));
    }

    public function create()
    {
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_lang', $default_lang)
            ->selection()
            ->get();
         $subject = Subjects::all()->sortByDesc('id');
        $majors = Major::all()->sortByDesc('id');
        $groups = Groups::all()->sortByDesc('id');
        $teachers = Teacher::all()->sortByDesc('id');
        return view('admin.materials.create', compact('categories', 'subject', 'majors' ,'groups' ,'teachers'));



    }

    public function store(MaterialsRequest $request)
    {
    // dd($request);
        try {
            $main_matrils = collect($request->mater);

            $filter = $main_matrils->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });
// save defulte lang in data base-------------///
            $default_matrils = array_values($filter->all()) [0];


            $filePath = "";
            if ($request->has('material')) {

                $filePath = uploadFiles('matrels', $request->material);
                // DB::beginTransaction();

            }
// save another lange--------//

        $default_matrils_id = Materials::insertGetId([
                'translation_lang' => $default_matrils['abbr'],
                'translation_of' => 0,
                'name_id' => $default_matrils['name_id'],
                'name' => $default_matrils['name'],
                'group_id' => $default_matrils['group_id'],
                'major_id' => $default_matrils['major_id'],
                'teacher_id' => $default_matrils['teacher_id'],
                'material' => $filePath
            ]);

        $matrils = $main_matrils->filter(function ($value, $key) {
            return $value['abbr'] !== get_default_lang();
        });


            if (isset($matrils) && $matrils->count()) {

                $matrils_arr = [];
                foreach ($matrils as $matril) {
                    $matrils_arr[] = [
                        'translation_lang' => $matril['abbr'],
                        'translation_of' => $default_matrils_id,
                        'name_id' => $matril['name_id'],
                        'name' => $matril['name'],
                        'group_id' => $matril['group_id'],
                        'major_id' => $matril['major_id'],
                        'teacher_id' => $matril['teacher_id'],
                        'material' => $filePath
                    ];
                }

                Materials::insert($matrils_arr);
            }

            DB::commit();

            return redirect()->route('admin.materials')->with(['success' => 'تم الحفظ بنجاح']);
        }
        catch (\Exception $ex){

            DB::rollback();
            return redirect()->route('admin.materials')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }



    }

///-------------edite------------//
    public function edit($matrial_id)
    {


        //get specific categories and its translations
        $mainmatrils = Materials::with('matrils')
            ->selection()
            ->find($matrial_id);
             $subject = Subjects::all()->sortByDesc('id');
            $majors = Major::all()->sortByDesc('id');
            $groups = Groups::all()->sortByDesc('id');
            $teachers = Teacher::all()->sortByDesc('id');

        if (!$mainmatrils)
            return redirect()->route('admin.materials')->with(['error' => 'هذا القسم غير موجود ']);
        $categories = MainCategory::all();

        return view('admin.materials.edit', compact('mainmatrils' ,'categories' ,'subject', 'majors' ,'groups' ,'teachers'));
    }


    public function update($matrial_id, MaterialsRequest $request)
    {
// return  $request;

        // try {


            $type_matrial = Materials::find($matrial_id);

            if (!$type_matrial)
                return redirect()->route('admin.materials')->with(['error' => 'هذا القسم غير موجود ']);

            // update date

            $matrils = array_values($request->mater) [0];

            if (!$request->has('mater.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);


                Materials::where('id', $matrial_id)
                ->update([
                    'name_id' => $matrils['name_id'],
                    'name' => $matrils['name'],
                    'group_id' => $matrils['group_id'],
                    'major_id' => $matrils['major_id'],
                    'teacher_id' => $matrils['teacher_id'],
                    'active' => $request->active,
                ]);

            // save image

            if ($request->has('material')) {
                $filePath = uploadImage('matrels', $request->material);
                Materials::where('id', $matrial_id)
                    ->update([
                        'material' => $filePath,
                    ]);
            }


            return redirect()->route('admin.materials')->with(['success' => 'تم ألتحديث بنجاح']);
        // } catch (\Exception $ex) {

        //     return redirect()->route('admin.materials')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        // }

    }


    public function destroy($id)
    {


            $matrils = Materials::find($id);
            if (!$matrils)
                return redirect()->route('admin.materials')->with(['error' => 'هذا القسم غير موجود ']);

            // $vendors = $group->vendors();
            // if (isset($vendors) && $vendors->count() > 0) {
            //     return redirect()->route('admin.materials')->with(['error' => 'لأ يمكن حذف هذا القسم  ']);
            // }

            $files = Str::after($matrils->material, '/');
            $files = base_path('/' . $files);
//            unlink($image); //delete from folder

            $matrils->delete();
            return redirect()->route('admin.materials')->with(['success' => 'تم حذف القسم بنجاح']);

//        } catch (\Exception $ex) {
//            return redirect()->route('admin.typeusers')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
//        }
    }

    public function changeStatus($id)
    {
        try {
            $matrils = Materials::find($id);
            if (!$matrils)
                return redirect()->route('admin.materials')->with(['error' => 'هذا القسم غير موجود ']);

            $status =  $matrils -> active  == 0 ? 1 : 0;

            $matrils -> update(['active' =>$status ]);

            return redirect()->route('admin.materials')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.materials')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


}
