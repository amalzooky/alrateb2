<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgoaldsRequest;
use App\Models\MainCategory;

use App\Models\Goals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use DB;
use Illuminate\Support\Str;
class GoalsController extends Controller
{
    public function index()
    {
        //  get defulte lang //
        $default_lang = get_default_lang();
                //  select maicatigory  by main catigory//

        $goales = Goals::where('translation_lang', $default_lang)
            ->selection()
            ->get();
            $categories = MainCategory::where('translation_lang', $default_lang)->get();



        return view('admin.goal.index', compact('categories' ,'goales'));
    }

    public function create()
    {
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        $goalees = Goals::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        return view('admin.goal.create', compact('goalees' ,'categories'));
    }


    public function store(AgoaldsRequest $request)
    {
            // dd($request);

        try {
            // return $request;

            $goales = collect($request->gold);

            $filter = $goales->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            $default_gols = array_values($filter->all()) [0];


            $filePath = "";
            if ($request->has('photo')) {

                $filePath = uploadImage('goals', $request->photo);
            }

            DB::beginTransaction();

            $default_gols_id = Goals::insertGetId([
                'translation_lang' => $default_gols['abbr'],
                'translation_of' => 0,
                'name' => $default_gols['name'],
                'text' => $default_gols['text'],
               
                'photo' => $filePath
            ]);

            $goless = $goales->filter(function ($value, $key) {
                return $value['abbr'] != get_default_lang();
            });


            if (isset($goless) && $goless->count()) {

                $goles_arr = [];
                foreach ($goless as $gole) {
                    $goles_arr[] = [
                        'translation_lang' => $gole['abbr'],
                        'translation_of' => $default_gols_id,
                        'name' => $gole['name'],
                        'text' => $gole['text'],
                        'photo' => $filePath
                    ];
                }

                Goals::insert($goles_arr);
            }

            DB::commit();

            return redirect()->route('admin.goald')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.goald')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function edit($gold_id)
    {

        //get specific categories and its translations
        $maingoals = Goals::with('goaless')
            ->selection()
            ->find($gold_id);

            // dd($maingoals);

        if (!$maingoals)
            return redirect()->route('admin.goald')->with(['error' => 'هذا القسم غير موجود ']);
            $categories = MainCategory::all();


        return view('admin.goal.edit', compact('maingoals', 'categories'));
    }


    public function update($gols_id, AgoaldsRequest $request)
    {


        // try {
            $goales = Goals::find($gols_id);

            if (!$goales)
                return redirect()->route('admin.goald')->with(['error' => 'هذا القسم غير موجود ']);

            // update date

            $goals = array_values($request->gold) [0];

            if (!$request->has('gold.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);


                Goals::where('id', $gols_id)
                ->update([
                    'name' => $goals['name'],
                    'text' => $goals['text'],
                    'active' => $request->active,
                ]);

            // save image

            if ($request->has('photo')) {
                $filePath = uploadImage('goals', $request->photo);
                Goals::where('id', $gols_id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }


            return redirect()->route('admin.goald')->with(['success' => 'تم ألتحديث بنجاح']);
        // } catch (\Exception $ex) {

        //     return redirect()->route('admin.services')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        // }

    }


    public function destroy($id)
    {
        // try {


            $maingolals = Goals::find($id);
            if (!$maingolals)
                return redirect()->route('admin.goals')->with(['error' => 'هذا القسم غير موجود ']);

                $image = $maingolals->photo;
                if (Goals::where('id', $id)->delete()){
                    !empty($image) && file_exists($image) ? unlink($image) : null;
                }
                

            // $image = Str::after($maislider->photo, '/');
            // $image = base_path('/' . $image);
            // unlink($image); //delete from folder

            $maingolals->delete();
            return redirect()->route('admin.goald')->with(['success' => 'تم حذف القسم بنجاح']);

    //   } catch (\Exception $ex) {
    //         return redirect()->route('admin.slider')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    //   }
    }

    public function changeStatus($id)
    {
        try {
            $maingolals = Goals::find($id);
            if (!$maingolals)
                return redirect()->route('admin.goals')->with(['error' => 'هذا القسم غير موجود ']);

           $status =  $maingolals -> active  == 0 ? 1 : 0;

           $maingolals -> update(['active' =>$status ]);

            return redirect()->route('admin.goald')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.goald')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}

