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

class NewsController extends Controller
{
    public function index()
    {
        //  get defulte lang //
        $default_lang = get_default_lang();
                //  select maicatigory  by main catigory//

        $news = News::where('translation_lang', $default_lang)
            ->selection()
            ->get();
            $categories = MainCategory::where('translation_lang', $default_lang)->get();



        return view('admin.news.index', compact('categories' ,'news'));
    }

    public function create()
    {
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        $news = News::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        return view('admin.news.create', compact('news' ,'categories'));
    }


    public function store(NewsRequest $request)
    {
            // return $request;

        try {
            // return $request;

            $news = collect($request->newe);

            $filter = $news->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            $default_new = array_values($filter->all()) [0];


            $filePath = "";
            if ($request->has('photo')) {

                $filePath = uploadImage('aboutus', $request->photo);
            }

            DB::beginTransaction();

            $default_new_id = News::insertGetId([
                'translation_lang' => $default_new['abbr'],
                'translation_of' => 0,
                'name' => $default_new['name'],
                'text' => $default_new['text'],
               
                'photo' => $filePath
            ]);

            $newss = $news->filter(function ($value, $key) {
                return $value['abbr'] != get_default_lang();
            });


            if (isset($newss) && $newss->count()) {

                $news_arr = [];
                foreach ($newss as $new) {
                    $news_arr[] = [
                        'translation_lang' => $new['abbr'],
                        'translation_of' => $default_new_id,
                        'name' => $new['name'],
                        'text' => $new['text'],
                        'photo' => $filePath
                    ];
                }

                News::insert($news_arr);
            }

            DB::commit();

            return redirect()->route('admin.news')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.news')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function edit($nww_id)
    {

        //get specific categories and its translations
        $mainnews = News::with('services')
            ->selection()
            ->find($nww_id);

            // return($mainserves);

        if (!$mainnews)
            return redirect()->route('admin.news')->with(['error' => 'هذا القسم غير موجود ']);
            $categories = MainCategory::all();


        return view('admin.news.edit', compact('mainnews', 'categories'));
    }


    public function update($nww_id, AboutRequest $request)
    {


        // try {
            $news = About::find($nww_id);

            if (!$news)
                return redirect()->route('admin.news')->with(['error' => 'هذا القسم غير موجود ']);

            // update date

            $news = array_values($request->newe) [0];

            if (!$request->has('newe.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);


                News::where('id', $nww_id)
                ->update([
                    'name' => $news['name'],
                    'text' => $news['text'],
                    'active' => $request->active,
                ]);

            // save image

            if ($request->has('photo')) {
                $filePath = uploadImage('news', $request->photo);
                News::where('id', $nww_id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }


            return redirect()->route('admin.news')->with(['success' => 'تم ألتحديث بنجاح']);
        // } catch (\Exception $ex) {

        //     return redirect()->route('admin.services')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        // }

    }


    public function destroy($id)
    {
        try {


            $mainabout = News::find($id);
            if (!$mainabout)
                return redirect()->route('admin.news')->with(['error' => 'هذا القسم غير موجود ']);

                $image = $mainabout->photo;
                if (About::where('id', $id)->delete()){
                    !empty($image) && file_exists($image) ? unlink($image) : null;
                }
                

            // $image = Str::after($maislider->photo, '/');
            // $image = base_path('/' . $image);
            // unlink($image); //delete from folder

            $mainabout->delete();
            return redirect()->route('admin.news')->with(['success' => 'تم حذف القسم بنجاح']);

      } catch (\Exception $ex) {
            return redirect()->route('admin.news')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
      }
    }

    public function changeStatus($id)
    {
        try {
            $mainabout = About::find($id);
            if (!$mainabout)
                return redirect()->route('admin.news')->with(['error' => 'هذا القسم غير موجود ']);

           $status =  $mainabout -> active  == 0 ? 1 : 0;

           $mainabout -> update(['active' =>$status ]);

            return redirect()->route('admin.news')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.news')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}


