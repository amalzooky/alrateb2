<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\MainCategory;

use App\Models\SLider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use DB;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index()
    {
        //  get defulte lang //
        $default_lang = get_default_lang();
                //  select maicatigory  by main catigory//

        $slider = Slider::where('translation_lang', $default_lang)
            ->selection()
            ->get();
            $categories = MainCategory::where('translation_lang', $default_lang)->get();



        return view('admin.sliders.index', compact('categories' ,'slider'));
    }

    public function create()
    {
        $default_lang = get_default_lang();
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        $slider = Slider::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        return view('admin.sliders.create', compact('slider' ,'categories'));
    }


    public function store(SliderRequest $request)
    {

        try {
            // return $request;

            $slider = collect($request->slid);

            $filter = $slider->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            $default_slider = array_values($filter->all()) [0];


            $filePath = "";
            if ($request->has('photo')) {

                $filePath = uploadImage('sliders', $request->photo);
            }

            DB::beginTransaction();

            $default_slider_id = Slider::insertGetId([
                'translation_lang' => $default_slider['abbr'],
                'translation_of' => 0,
                'name' => $default_slider['name'],
                'text' => $default_slider['text'],
               
                'photo' => $filePath
            ]);

            $sliders = $slider->filter(function ($value, $key) {
                return $value['abbr'] != get_default_lang();
            });


            if (isset($sliders) && $sliders->count()) {

                $sliders_arr = [];
                foreach ($sliders as $slide) {
                    $sliders_arr[] = [
                        'translation_lang' => $slide['abbr'],
                        'translation_of' => $default_slider_id,
                        'name' => $slide['name'],
                        'text' => $slide['text'],
                        'photo' => $filePath
                    ];
                }

                Slider::insert($sliders_arr);
            }

            DB::commit();

            return redirect()->route('admin.slider')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.slider')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function edit($slid_id)
    {

        //get specific categories and its translations
        $mainsliders = Slider::with('slideres')
            ->selection()
            ->find($slid_id);
            
            // return($mainsliders);

        if (!$mainsliders)
            return redirect()->route('admin.slider')->with(['error' => 'هذا القسم غير موجود ']);
            $categories = MainCategory::all();


        return view('admin.sliders.edit', compact('mainsliders', 'categories'));
    }


    public function update($slid_id, SliderRequest $request)
    {


        try {
            $slider = Slider::find($slid_id);

            if (!$slider)
                return redirect()->route('admin.slider')->with(['error' => 'هذا القسم غير موجود ']);

            // update date

            $slides = array_values($request->slid) [0];

            if (!$request->has('slid.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);


                Slider::where('id', $slid_id)
                ->update([
                    'name' => $slides['name'],
                    'text' => $slides['text'],
                    'active' => $request->active,
                ]);

            // save image

            if ($request->has('photo')) {
                $filePath = uploadImage('sliders', $request->photo);
                Slider::where('id', $slid_id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }


            return redirect()->route('admin.slider')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.slider')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function destroy($id)
    {
        // try {


            $maislider = Slider::find($id);
            if (!$maislider)
                return redirect()->route('admin.slider')->with(['error' => 'هذا القسم غير موجود ']);

                $image = $maislider->photo;
                if (Slider::where('id', $id)->delete()){
                    !empty($image) && file_exists($image) ? unlink($image) : null;
                }
                

            // $image = Str::after($maislider->photo, '/');
            // $image = base_path('/' . $image);
            // unlink($image); //delete from folder

            $maislider->delete();
            return redirect()->route('admin.slider')->with(['success' => 'تم حذف القسم بنجاح']);

    //   } catch (\Exception $ex) {
    //         return redirect()->route('admin.slider')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    //   }
    }

    public function changeStatus($id)
    {
        try {
            $maislider = Slider::find($id);
            if (!$maislider)
                return redirect()->route('admin.slider')->with(['error' => 'هذا القسم غير موجود ']);

           $status =  $maislider -> active  == 0 ? 1 : 0;

           $maislider -> update(['active' =>$status ]);

            return redirect()->route('admin.slider')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.slider')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
