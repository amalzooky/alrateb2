<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvisionsRequest;
use App\Models\MainCategory;

use App\Models\Vision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use DB;
use Illuminate\Support\Str;
class VisionController extends Controller
{
    public function index()
    {
        //  get defulte lang //
        $default_lang = get_default_lang();
                //  select maicatigory  by main catigory//

        $visions = Vision::where('translation_lang', $default_lang)
            ->selection()
            ->get();
            $categories = MainCategory::where('translation_lang', $default_lang)->get();



        return view('admin.visions.index', compact('categories' ,'visions'));
    }

    public function create()
    {
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        $visions = Vision::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        return view('admin.visions.create', compact('visions' ,'categories'));
    }


    public function store(AvisionsRequest $request)
    {
            // return $request;

        try {
            // return $request;

            $visions = collect($request->visn);

            $filter = $visions->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            $default_vision = array_values($filter->all()) [0];


            $filePath = "";
            if ($request->has('photo')) {

                $filePath = uploadImage('visions', $request->photo);
            }

            DB::beginTransaction();

            $default_vision_id = Vision::insertGetId([
                'translation_lang' => $default_vision['abbr'],
                'translation_of' => 0,
                'name' => $default_vision['name'],
                'text' => $default_vision['text'],
               
                'photo' => $filePath
            ]);

            $visiones= $visions->filter(function ($value, $key) {
                return $value['abbr'] != get_default_lang();
            });


            if (isset($visiones) && $visiones->count()) {

                $vision_arr = [];
                foreach ($visiones as $visio) {
                    $vision_arr[] = [
                        'translation_lang' => $visio['abbr'],
                        'translation_of' => $default_vision_id,
                        'name' => $visio['name'],
                        'text' => $visio['text'],
                        'photo' => $filePath
                    ];
                }

                Vision::insert($vision_arr);
            }

            DB::commit();

            return redirect()->route('admin.vision')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.vision')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function edit($vis_id)
    {

        //get specific categories and its translations
        $mainvision = Vision::with('visiones')
            ->selection()
            ->find($vis_id);

            // return($mainserves);

        if (!$mainvision)
            return redirect()->route('admin.vision')->with(['error' => 'هذا القسم غير موجود ']);
            $categories = MainCategory::all();


        return view('admin.visions.edit', compact('mainvision', 'categories'));
    }


    public function update($vis_id, AvisionsRequest $request)
    {

// dd($request);
        // try {
            $visions = Vision::find($vis_id);

            if (!$visions)
                return redirect()->route('admin.vision')->with(['error' => 'هذا القسم غير موجود ']);

            // update date

            $visions = array_values($request->visn) [0];

            if (!$request->has('visn.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);


                Vision::where('id', $vis_id)
                ->update([
                    'name' => $visions['name'],
                    'text' => $visions['text'],
                    'active' => $request->active,
                ]);

            // save image

            if ($request->has('photo')) {
                $filePath = uploadImage('visions', $request->photo);
                Vision::where('id', $vis_id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }


            return redirect()->route('admin.vision')->with(['success' => 'تم ألتحديث بنجاح']);
        // } catch (\Exception $ex) {

        //     return redirect()->route('admin.services')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        // }

    }


    public function destroy($id)
    {
        // try {


            $mainvision= Vision::find($id);
            if (!$mainvision)
                return redirect()->route('admin.vision')->with(['error' => 'هذا القسم غير موجود ']);

                $image = $mainvision->photo;
                if (Vision::where('id', $id)->delete()){
                    !empty($image) && file_exists($image) ? unlink($image) : null;
                }
                

            // $image = Str::after($maislider->photo, '/');
            // $image = base_path('/' . $image);
            // unlink($image); //delete from folder

            $mainvision->delete();
            return redirect()->route('admin.vision')->with(['success' => 'تم حذف القسم بنجاح']);

    //   } catch (\Exception $ex) {
    //         return redirect()->route('admin.slider')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    //   }
    }

    public function changeStatus($id)
    {
        try {
            $mainvision = Vision::find($id);
            if (!$mainvision)
                return redirect()->route('admin.vision')->with(['error' => 'هذا القسم غير موجود ']);

           $status =  $mainvision -> active  == 0 ? 1 : 0;

           $mainvision -> update(['active' =>$status ]);

            return redirect()->route('admin.vision')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.vision')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


}
