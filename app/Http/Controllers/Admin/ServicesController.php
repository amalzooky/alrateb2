<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\MainCategory;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use DB;
use Illuminate\Support\Str;
class ServicesController extends Controller
{
    public function index()
    {
        //  get defulte lang //
        $default_lang = get_default_lang();
                //  select maicatigory  by main catigory//

        $services = Service::where('translation_lang', $default_lang)
            ->selection()
            ->get();
            $categories = MainCategory::where('translation_lang', $default_lang)->get();



        return view('admin.service.index', compact('categories' ,'services'));
    }

    public function create()
    {
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        $services = Service::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        return view('admin.service.create', compact('services' ,'categories'));
    }


    public function store(ServiceRequest $request)
    {
            // return $request;

        try {
            return $request;

            $services = collect($request->serve);

            $filter = $services->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            $default_serve = array_values($filter->all()) [0];


            $filePath = "";
            if ($request->has('photo')) {

                $filePath = uploadImage('services', $request->photo);
            }

            DB::beginTransaction();

            $default_service_id = Service::insertGetId([
                'translation_lang' => $default_serve['abbr'],
                'translation_of' => 0,
                'name' => $default_serve['name'],
                'text' => $default_serve['text'],
               
                'photo' => $filePath
            ]);

            $serves = $services->filter(function ($value, $key) {
                return $value['abbr'] != get_default_lang();
            });


            if (isset($serves) && $serves->count()) {

                $serves_arr = [];
                foreach ($serves as $serve) {
                    $serves_arr[] = [
                        'translation_lang' => $serve['abbr'],
                        'translation_of' => $default_service_id,
                        'name' => $serve['name'],
                        'text' => $serve['text'],
                        'photo' => $filePath
                    ];
                }

                Service::insert($serves_arr);
            }

            DB::commit();

            return redirect()->route('admin.services')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.services')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function edit($serv_id)
    {

        //get specific categories and its translations
        $mainserves = Service::with('services')
            ->selection()
            ->find($serv_id);

            // return($mainserves);

        if (!$mainserves)
            return redirect()->route('admin.services')->with(['error' => 'هذا القسم غير موجود ']);
            $categories = MainCategory::all();


        return view('admin.service.edit', compact('mainserves', 'categories'));
    }


    public function update($serve_id, ServiceRequest $request)
    {


        // try {
            $serves = Service::find($serve_id);

            if (!$serves)
                return redirect()->route('admin.services')->with(['error' => 'هذا القسم غير موجود ']);

            // update date

            $servers = array_values($request->serve) [0];

            if (!$request->has('serve.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);


                Service::where('id', $serve_id)
                ->update([
                    'name' => $servers['name'],
                    'text' => $servers['text'],
                    'active' => $request->active,
                ]);

            // save image

            if ($request->has('photo')) {
                $filePath = uploadImage('services', $request->photo);
                Service::where('id', $serve_id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }


            return redirect()->route('admin.services')->with(['success' => 'تم ألتحديث بنجاح']);
        // } catch (\Exception $ex) {

        //     return redirect()->route('admin.services')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        // }

    }


    public function destroy($id)
    {
        try {


            $mainserves = Service::find($id);
            if (!$mainserves)
                return redirect()->route('admin.services')->with(['error' => 'هذا القسم غير موجود ']);

                $image = $mainserves->photo;
                if (Service::where('id', $id)->delete()){
                    !empty($image) && file_exists($image) ? unlink($image) : null;
                }
                

            // $image = Str::after($maislider->photo, '/');
            // $image = base_path('/' . $image);
            // unlink($image); //delete from folder

            $mainserves->delete();
            return redirect()->route('admin.services')->with(['success' => 'تم حذف القسم بنجاح']);

      } catch (\Exception $ex) {
            return redirect()->route('admin.slider')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
      }
    }

    public function changeStatus($id)
    {
        try {
            $mainserves = Service::find($id);
            if (!$mainserves)
                return redirect()->route('admin.services')->with(['error' => 'هذا القسم غير موجود ']);

           $status =  $mainserves -> active  == 0 ? 1 : 0;

           $mainserves -> update(['active' =>$status ]);

            return redirect()->route('admin.services')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.services')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
