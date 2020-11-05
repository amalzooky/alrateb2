<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SloganRequest;
use App\Models\MainCategory;

use App\Models\Slogan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use DB;
use Illuminate\Support\Str;

class SloganController extends Controller
{
    public function index()
    {
        //  get defulte lang //
        $default_lang = get_default_lang();
                //  select maicatigory  by main catigory//

        $slogans = Slogan::where('translation_lang', $default_lang)
            ->selection()
            ->get();
            $categories = MainCategory::where('translation_lang', $default_lang)->get();



        return view('admin.slogans.index', compact('categories' ,'slogans'));
    }

    public function create()
    {
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        $slogans = Slogan::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        return view('admin.slogans.create', compact('slogans' ,'categories'));
    }


    public function store(SloganRequest $request)
    {
            // return $request;

        try {
            // return $request;

            $slogans = collect($request->slog);

            $filter = $slogans->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            $default_slogan = array_values($filter->all()) [0];


            $filePath = "";
            if ($request->has('photo')) {

                $filePath = uploadImage('slogan', $request->photo);
            }

            DB::beginTransaction();

            $default_sloag_id = Slogan::insertGetId([
                'translation_lang' => $default_slogan['abbr'],
                'translation_of' => 0,
                'name' => $default_slogan['name'],
                'text' => $default_slogan['text'],
               
                'photo' => $filePath
            ]);

            $sloganess = $slogans->filter(function ($value, $key) {
                return $value['abbr'] != get_default_lang();
            });


            if (isset($sloganess) && $sloganess->count()) {

                $slogan_arr = [];
                foreach ($sloganess as $slogane) {
                    $slogan_arr[] = [
                        'translation_lang' => $slogane['abbr'],
                        'translation_of' => $default_sloag_id,
                        'name' => $slogane['name'],
                        'text' => $slogane['text'],
                        'photo' => $filePath
                    ];
                }

                Slogan::insert($slogan_arr);
            }

            DB::commit();

            return redirect()->route('admin.slogan')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.slogan')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function edit($slog_id)
    {

        //get specific categories and its translations
        $mainsloagans = Slogan::with('sloganess')
            ->selection()
            ->find($slog_id);

            // return($mainserves);

        if (!$mainsloagans)
            return redirect()->route('admin.slogan')->with(['error' => 'هذا القسم غير موجود ']);
            $categories = MainCategory::all();


        return view('admin.slogans.edit', compact('mainsloagans', 'categories'));
    }


    public function update($slogn_id, SloganRequest $request)
    {


        // try {
            $slogans = Slogan::find($slogn_id);

            if (!$slogans)
                return redirect()->route('admin.slogan')->with(['error' => 'هذا القسم غير موجود ']);

            // update date

            $slogans = array_values($request->slog) [0];

            if (!$request->has('slog.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);


                Slogan::where('id', $slogn_id)
                ->update([
                    'name' => $slogans['name'],
                    'text' => $slogans['text'],
                    'active' => $request->active,
                ]);

            // save image

            if ($request->has('photo')) {
                $filePath = uploadImage('slogan', $request->photo);
                Slogan::where('id', $serve_id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }


            return redirect()->route('admin.slogan')->with(['success' => 'تم ألتحديث بنجاح']);
        // } catch (\Exception $ex) {

        //     return redirect()->route('admin.services')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        // }

    }


    public function destroy($id)
    {
        // try {


            $mainslog = Slogan::find($id);
            if (!$mainslog)
                return redirect()->route('admin.slogan')->with(['error' => 'هذا القسم غير موجود ']);

                $image = $mainslog->photo;
                if (Slogan::where('id', $id)->delete()){
                    !empty($image) && file_exists($image) ? unlink($image) : null;
                }
                

            // $image = Str::after($maislider->photo, '/');
            // $image = base_path('/' . $image);
            // unlink($image); //delete from folder

            $mainslog->delete();
            return redirect()->route('admin.slogan')->with(['success' => 'تم حذف القسم بنجاح']);

    //   } catch (\Exception $ex) {
    //         return redirect()->route('admin.slider')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    //   }
    }

    public function changeStatus($id)
    {
        try {
            $mainslog = Slogan::find($id);
            if (!$mainslog)
                return redirect()->route('admin.slogan')->with(['error' => 'هذا القسم غير موجود ']);

           $status =  $mainslog -> active  == 0 ? 1 : 0;

           $mainslog -> update(['active' =>$status ]);

            return redirect()->route('admin.slogan')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.slogan')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


}
