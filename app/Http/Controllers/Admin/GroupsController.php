<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupsRequest;
use App\Models\MainCategory;
use App\Models\Groups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
class GroupsController extends Controller
{

    public function index()
    {
        $default_lang = get_default_lang();
        $groups = Groups::where('translation_lang', $default_lang)
            ->selection()
            ->get();
            $categories = MainCategory::where('translation_lang', $default_lang)->get();


        return view('admin.groups.index', compact('groups' ,'categories'));
    }

    public function create()
    {
        $categories = MainCategory::all();

        return view('admin.groups.create' , compact('categories'));

    }

    public function store(GroupsRequest $request)
    {
    // return $request;
        try {


            $main_groups = collect($request->groupe);

            $filter = $main_groups->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });
// save defulte lang in data base-------------///
            $default_groups = array_values($filter->all()) [0];


            $filePath = "";
            if ($request->has('photo')) {

                $filePath = uploadImage('groups', $request->photo);
                // DB::beginTransaction();

            }
// save another lange--------//

        $default_group_id = Groups::insertGetId([
                'translation_lang' => $default_groups['abbr'],
                'translation_of' => 0,
                'name' => $default_groups['name'],
                'photo' => $filePath
            ]);

        $groupss = $main_groups->filter(function ($value, $key) {
            return $value['abbr'] !== get_default_lang();
        });


            if (isset($groupss) && $groupss->count()) {

                $groupss_arr = [];
                foreach ($groupss as $group) {
                    $groupss_arr[] = [
                        'translation_lang' => $group['abbr'],
                        'translation_of' => $default_group_id,
                        'name' => $group['name'],
                        'photo' => $filePath
                    ];
                }

                Groups::insert($groupss_arr);
            }

            // DB::commit();

            return redirect()->route('admin.groupes')->with(['success' => 'تم الحفظ بنجاح']);
        }
        catch (\Exception $ex){

            DB::rollback();
            return redirect()->route('admin.groups')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }


    }

///-------------edite------------//
    public function edit($group_id)
    {
        //get specific categories and its translations
        $maingroups = Groups::with('group')
            ->selection()
            ->find($group_id);
        if (!$maingroups)
            return redirect()->route('admin.groups')->with(['error' => 'هذا القسم غير موجود ']);
        $categories = MainCategory::all();

        return view('admin.groups.edit', compact('maingroups' ,'categories'));
    }


    public function update($group_id, GroupsRequest $request)
    {


        try {


            $type_group = Groups::find($group_id);

            if (!$type_group)
                return redirect()->route('admin.groups')->with(['error' => 'هذا القسم غير موجود ']);

            // update date

            $groups = array_values($request->group) [0];

            if (!$request->has('group.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);


            Groups::where('id', $group_id)
                ->update([
                    'group_name' => $groups['group_name'],
                    'active' => $groups->active,
                ]);

            // save image

            if ($request->has('group_image')) {
                $filePath = uploadImage('groups', $request->group_image);
                Groups::where('id', $group_id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }


            return redirect()->route('admin.groups')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.groups')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function destroy($id)
    {


            $group = Groups::find($id);
            if (!$group)
                return redirect()->route('admin.groups')->with(['error' => 'هذا القسم غير موجود ']);

            $vendors = $group->vendors();
            if (isset($vendors) && $vendors->count() > 0) {
                return redirect()->route('admin.groups')->with(['error' => 'لأ يمكن حذف هذا القسم  ']);
            }

            $image = Str::after($group->group_image, '/');
            $image = base_path('/' . $image);
//            unlink($image); //delete from folder

            $group->delete();
            return redirect()->route('admin.groups')->with(['success' => 'تم حذف القسم بنجاح']);

//        } catch (\Exception $ex) {
//            return redirect()->route('admin.typeusers')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
//        }
    }

    public function changeStatus($id)
    {
        try {
            $group = Groups::find($id);
            if (!$group)
                return redirect()->route('admin.groups')->with(['error' => 'هذا القسم غير موجود ']);

            $status =  $group -> active  == 0 ? 1 : 0;

            $group -> update(['active' =>$status ]);

            return redirect()->route('admin.groups')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.groups')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
