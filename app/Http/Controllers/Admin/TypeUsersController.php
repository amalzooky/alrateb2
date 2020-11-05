<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\TypeUsersRequest;

use App\Http\Controllers\Controller;
use App\Models\TypeUser;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
use DB;


class TypeUsersController extends Controller
{
    public function index()
    {
        $default_lang = get_default_lang();
        $typeusers = TypeUser::where('translation_lang', $default_lang)
            ->selection()
            ->get();
        $categories = MainCategory::all();


        return view('admin.typeuser.index', compact('typeusers' ,'categories'));
    }

    public function create()
    {
        $categories = MainCategory::all();

        return view('admin.typeuser.create' , compact('categories'));

    }


    public function store(TypeUsersRequest $request)
    {
        try {


            $main_typeusers = collect($request->typeuser);

            $filter = $main_typeusers->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });
// save defulte lang in data base-------------///
            $default_typeuser = array_values($filter->all()) [0];


            $filePath = "";
            if ($request->has('photo')) {

                $filePath = uploadImage('typeusers', $request->photo);
                DB::beginTransaction();

            }
// save another lange--------//

        $default_typeuser_id = TypeUser::insertGetId([
                'translation_lang' => $default_typeuser['abbr'],
                'translation_of' => 0,
                'name' => $default_typeuser['name'],
                'photo' => $filePath
            ]);

        $typeuserss = $main_typeusers->filter(function ($value, $key) {
            return $value['abbr'] !== get_default_lang();
        });


            if (isset($typeuserss) && $typeuserss->count()) {

                $typeusers_arr = [];
                foreach ($typeuserss as $typeusers) {
                    $typeusers_arr[] = [
                        'translation_lang' => $typeusers['abbr'],
                        'translation_of' => $default_typeuser_id,
                        'name' => $typeusers['name'],
                        'photo' => $filePath
                    ];
                }

                TypeUser::insert($typeusers_arr);
            }

            DB::commit();

            return redirect()->route('admin.typeusers')->with(['success' => 'تم الحفظ بنجاح']);
        }
        catch (\Exception $ex){

            DB::rollback();
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }


    }

///-------------edite------------//
    public function edit($taprUser_id)
    {
        //get specific categories and its translations
        $maintypeUsers = TypeUser::with('type_User')
            ->selection()
            ->find($taprUser_id);
        if (!$maintypeUsers)
            return redirect()->route('admin.typeusers')->with(['error' => 'هذا القسم غير موجود ']);
        $categories = MainCategory::all();

        return view('admin.typeuser.edit', compact('maintypeUsers' ,'categories'));
    }


    public function update($taprUser_id, TypeUsersRequest $request)
    {


        try {


            $type_user = TypeUser::find($taprUser_id);

            if (!$type_user)
                return redirect()->route('admin.typeusers')->with(['error' => 'هذا القسم غير موجود ']);

            // update date

            $typeusers = array_values($request->typeuser) [0];

            if (!$request->has('type_user.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);


            TypeUser::where('id', $taprUser_id)
                ->update([
                    'name' => $typeusers['name'],
                    'active' => $request->active,
                ]);

            // save image

            if ($request->has('photo')) {
                $filePath = uploadImage('typeusers', $request->photo);
                TypeUser::where('id', $taprUser_id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }


            return redirect()->route('admin.typeusers')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.typeusers')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function destroy($id)
    {


            $typeuser = TypeUser::find($id);
            if (!$typeuser)
                return redirect()->route('admin.typeusers')->with(['error' => 'هذا القسم غير موجود ']);

            $vendors = $typeuser->vendors();
            if (isset($vendors) && $vendors->count() > 0) {
                return redirect()->route('admin.typeusers')->with(['error' => 'لأ يمكن حذف هذا القسم  ']);
            }


            $image = $typeuser->photo;
            if (TypeUser::where('id', $id)->delete()){
                !empty($image) && file_exists($image) ? unlink($image) : null;
            }


            // $image = Str::after($typeuser->photo, '/');
            // $image = base_path('/' . $image);
//            unlink($image); //delete from folder

            $typeuser->delete();
            return redirect()->route('admin.typeusers')->with(['success' => 'تم حذف القسم بنجاح']);

//        } catch (\Exception $ex) {
//            return redirect()->route('admin.typeusers')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
//        }
    }

    public function changeStatus($id)
    {
        try {
            $typeuser = TypeUser::find($id);
            if (!$typeuser)
                return redirect()->route('admin.typeusers')->with(['error' => 'هذا القسم غير موجود ']);

            $status =  $typeuser -> active  == 0 ? 1 : 0;

            $typeuser -> update(['active' =>$status ]);

            return redirect()->route('admin.typeusers')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.typeusers')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
