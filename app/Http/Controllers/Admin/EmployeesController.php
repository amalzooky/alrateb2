<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Models\MainCategory;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use DB;
use Illuminate\Support\Str;
class EmployeesController extends Controller
{
    public function index()
    {
        //  get defulte lang //
        $default_lang = get_default_lang();
                //  select maicatigory  by main catigory//

        $abouts = About::where('translation_lang', $default_lang)
            ->selection()
            ->get();
            $categories = MainCategory::where('translation_lang', $default_lang)->get();



        return view('admin.aboutus.index', compact('categories' ,'abouts'));
    }

    public function create()
    {
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        $abouts = About::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        return view('admin.aboutus.create', compact('abouts' ,'categories'));
    }


    public function store(AboutRequest $request)
    {
            // return $request;

        try {
            // return $request;

            $abouts = collect($request->about);

            $filter = $abouts->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            $default_about = array_values($filter->all()) [0];


            $filePath = "";
            if ($request->has('photo')) {

                $filePath = uploadImage('aboutus', $request->photo);
            }

            DB::beginTransaction();

            $default_about_id = About::insertGetId([
                'translation_lang' => $default_about['abbr'],
                'translation_of' => 0,
                'name' => $default_about['name'],
                'text' => $default_about['text'],
               
                'photo' => $filePath
            ]);

            $aboutus = $abouts->filter(function ($value, $key) {
                return $value['abbr'] != get_default_lang();
            });


            if (isset($aboutus) && $aboutus->count()) {

                $abouts_arr = [];
                foreach ($aboutus as $about) {
                    $serves_arr[] = [
                        'translation_lang' => $about['abbr'],
                        'translation_of' => $default_about_id,
                        'name' => $about['name'],
                        'text' => $about['text'],
                        'photo' => $filePath
                    ];
                }

                Service::insert($abouts_arr);
            }

            DB::commit();

            return redirect()->route('admin.aboutus')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.aboutus')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function edit($serv_id)
    {

        //get specific categories and its translations
        $mainabouts = About::with('services')
            ->selection()
            ->find($serv_id);

            // return($mainserves);

        if (!$mainabouts)
            return redirect()->route('admin.aboutus')->with(['error' => 'هذا القسم غير موجود ']);
            $categories = MainCategory::all();


        return view('admin.aboutus.edit', compact('mainabouts', 'categories'));
    }


    public function update($about_id, AboutRequest $request)
    {


        // try {
            $abouts = About::find($about_id);

            if (!$abouts)
                return redirect()->route('admin.aboutus')->with(['error' => 'هذا القسم غير موجود ']);

            // update date

            $abouts = array_values($request->about) [0];

            if (!$request->has('abouts.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);


                About::where('id', $about_id)
                ->update([
                    'name' => $abouts['name'],
                    'text' => $abouts['text'],
                    'active' => $request->active,
                ]);

            // save image

            if ($request->has('photo')) {
                $filePath = uploadImage('aboutus', $request->photo);
                About::where('id', $serve_id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }


            return redirect()->route('admin.aboutus')->with(['success' => 'تم ألتحديث بنجاح']);
        // } catch (\Exception $ex) {

        //     return redirect()->route('admin.services')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        // }

    }


    public function destroy($id)
    {
        // try {


            $mainabout = About::find($id);
            if (!$mainabout)
                return redirect()->route('admin.aboutus')->with(['error' => 'هذا القسم غير موجود ']);

                $image = $mainabout->photo;
                if (About::where('id', $id)->delete()){
                    !empty($image) && file_exists($image) ? unlink($image) : null;
                }
                

            // $image = Str::after($maislider->photo, '/');
            // $image = base_path('/' . $image);
            // unlink($image); //delete from folder

            $mainabout->delete();
            return redirect()->route('admin.aboutus')->with(['success' => 'تم حذف القسم بنجاح']);

    //   } catch (\Exception $ex) {
    //         return redirect()->route('admin.slider')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    //   }
    }

    public function changeStatus($id)
    {
        try {
            $mainabout = About::find($id);
            if (!$mainabout)
                return redirect()->route('admin.aboutus')->with(['error' => 'هذا القسم غير موجود ']);

           $status =  $mainabout -> active  == 0 ? 1 : 0;

           $mainabout -> update(['active' =>$status ]);

            return redirect()->route('admin.aboutus')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.aboutus')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
