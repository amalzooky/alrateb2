<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BestTeacherRequest;
use App\Models\MainCategory;
use App\Models\BestTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use DB;
use Illuminate\Support\Str;
class BestTeachersController extends Controller
{
    public function index()
    {
        //  get defulte lang //
        $default_lang = get_default_lang();
                //  select maicatigory  by main catigory//

        $bteachers = BestTeacher::where('translation_lang', $default_lang)
            ->selection()
            ->get();
            $categories = MainCategory::where('translation_lang', $default_lang)->get();



        return view('admin.best-teacher.index', compact('categories' ,'bteachers'));
    }

    public function create()
    {
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        $bteachers = BestTeacher::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        return view('admin.best-teacher.create', compact('bteachers' ,'categories'));
    }


    public function store(BestTeacherRequest $request)
    {
            // return $request;

        // try {
            // return $request;

            $bteachers = collect($request->btech);

            $filter = $bteachers->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            $default_btech = array_values($filter->all()) [0];


            $filePath = "";
            if ($request->has('photo')) {

                $filePath = uploadImage('bteachers', $request->photo);
            }

            DB::beginTransaction();

            $default_btech_id = BestTeacher::insertGetId([
                'translation_lang' => $default_btech['abbr'],
                'translation_of' => 0,
                'name' => $default_btech['name'],
                'text' => $default_btech['text'],
               
                'photo' => $filePath
            ]);

            $bteacheres = $bteachers->filter(function ($value, $key) {
                return $value['abbr'] != get_default_lang();
            });


            if (isset($bteacheres) && $bteacheres->count()) {

                $bteach_arr = [];
                foreach ($bteacheres as $btecher) {
                    $bteach_arr[] = [
                        'translation_lang' => $btecher['abbr'],
                        'translation_of' => $default_btech_id,
                        'name' => $btecher['name'],
                        'text' => $btecher['text'],
                        'photo' => $filePath
                    ];
                }

                BestTeacher::insert($bteach_arr);
            }

            DB::commit();

            return redirect()->route('admin.best-teacher')->with(['success' => 'تم الحفظ بنجاح']);

        // } catch (\Exception $ex) {
        //     DB::rollback();
        //     return redirect()->route('admin.best-teacher')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        // }

    }


    public function edit($btech_id)
    {

        //get specific categories and its translations
        $mainbteacher = BestTeacher::with('bteachers')
            ->selection()
            ->find($btech_id);

            // return($mainbteacher);

        if (!$mainbteacher)
            return redirect()->route('admin.best-teacher')->with(['error' => 'هذا القسم غير موجود ']);
            $categories = MainCategory::all();


        return view('admin.best-teacher.edit', compact('mainbteacher', 'categories'));
    }


    public function update($btech_id, BestTeacherRequest $request)
    {


        try {
            $bteachers = BestTeacher::find($btech_id);

            if (!$bteachers)
                return redirect()->route('admin.best-teacher')->with(['error' => 'هذا القسم غير موجود ']);

            // update date

            $bteachers = array_values($request->btech) [0];

            if (!$request->has('btech.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);


                BestTeacher::where('id', $btech_id)
                ->update([
                    'name' => $bteachers['name'],
                    'text' => $bteachers['text'],
                ]);

            // save image

            if ($request->has('photo')) {
                $filePath = uploadImage('bteachers', $request->photo);
                BestTeacher::where('id', $btech_id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }


            return redirect()->route('admin.best-teacher')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.services')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function destroy($id)
    {
        try {


            $mainbteacher = BestTeacher::find($id);
            if (!$mainbteacher)
                return redirect()->route('admin.best-teacher')->with(['error' => 'هذا القسم غير موجود ']);

                $image = $mainbteacher->photo;
                if (BestTeacher::where('id', $id)->delete()){
                    !empty($image) && file_exists($image) ? unlink($image) : null;
                }
                

            // $image = Str::after($maislider->photo, '/');
            // $image = base_path('/' . $image);
            // unlink($image); //delete from folder

            $mainbteacher->delete();
            return redirect()->route('admin.best-teacher')->with(['success' => 'تم حذف القسم بنجاح']);

      } catch (\Exception $ex) {
            return redirect()->route('admin.slider')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
      }
    }

    public function changeStatus($id)
    {
        try {
            $mainbteacher = BestTeacher::find($id);
            if (!$mainbteacher)
                return redirect()->route('admin.best-teacher')->with(['error' => 'هذا القسم غير موجود ']);

           $status =  $mainbteacher -> active  == 0 ? 1 : 0;

           $mainbteacher -> update(['active' =>$status ]);

            return redirect()->route('admin.best-teacher')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.best-teacher')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
