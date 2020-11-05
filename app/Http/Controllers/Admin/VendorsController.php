<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\Major;
use App\Models\SchoolsItems;
use App\Models\Schoolyear;
use App\Models\StudentsSubjects;
use App\Models\Subjects;
use App\Models\Groups;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class VendorsController extends Controller
{


    public function index()
    {
        $categories = MainCategory::where('translation_lang', get_default_lang())
            ->selection()
            ->get();
        $vendors = Vendor::all()->sortByDesc('id');
        return view('admin.students.index', compact('vendors', 'categories'));
    }
    // groupSelected
    public function create()
    {
        $categories = MainCategory::where('translation_of', 0)->active()->get();
        $majors = Major::all()->where('translation_lang', get_default_lang())->sortByDesc('id');
        $schools = SchoolsItems::all()->where('translation_lang', get_default_lang())->sortByDesc('school_id');
        $sc_years = Schoolyear::all()->where('translation_lang', get_default_lang())->sortByDesc('id');
        $subjects = Subjects::all()->where('translation_lang', get_default_lang())->sortByDesc('id');
        $groups = Groups::all()->where('translation_lang', get_default_lang())->sortByDesc('id');
        return view('admin.students.create', compact('categories', 'majors', 'schools', 'sc_years', 'subjects' ,'groups'));
    }

    public function store(Request $request)
    {

        try {
            $rules = [
                'avatar' => 'nullable|image',
                'fullname' => 'required|string',
                'username' => 'required|string',
                'mobile' => 'required|string',
                'telephone_fix' => 'nullable|string',
                'email' => 'required|email',
                'birthday' => 'required|date',
                'gender' => 'required|integer',
                'expire_date' => 'nullable|date',
                'city' => 'required|string',
                'password' => 'required',
                'fb_student' => 'nullable|url',
                'fb_parent' => 'nullable|url',
                'active' => 'nullable|integer',
                'show_notes' => 'nullable|integer',
                'notes'  => 'nullable|string',
                'major' => 'required|integer',
                'school' => 'nullable|integer',
                'group' => 'nullable|integer',
                'subject' => 'nullable|array',
                'subject.*' => 'nullable|array',
            ];

            $validator = Validator::make($request->all(), $rules);
            $requests = $request->all();
            if (key_exists('avatar', $requests)){ // remove avatar key because we cannot return it .. to undersand this comment try to return it
                unset($requests['avatar']);
            }
            if ($validator->fails()){
                return redirect()->route('admin.students.create')->with('errors', $validator->messages()->get('*'))->with('data', $requests);
            }

            if (Vendor::all()->where('username', $request->username)->count() > 0){
                return redirect()->route('admin.students.create')->with('errorUsername', 'اسم المستخدم مسجل بالفعل')->with('data', $requests);
            }

            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            if (!$request->has('show_notes'))
                $request->request->add(['show_notes' => 0]);
            else
                $request->request->add(['show_notes' => 1]);

            $filePath = null;
            if ($request->has('avatar')) {
                $filePath = uploadImage('vendors', $request->avatar);
            }

            $subjects = [];
            if (!empty($request->subject[0][0])){
                if (!empty($request->subject[0][0])){
                    $allSubjects = $request->subject;
                    foreach ($allSubjects as $subject){
                        if (isset($subject['price']) && !empty($subject['price'])) {
                            if (Subjects::find($subject[0]) === false)
                                return redirect('admin.students.create')->with('error', 'فشل فى اضافه المواد')->with('data', $requests);
                            else
                                $subjects[] = ['subject' => $subject[0], 'price' => $subject['price'], 'tax' => $subject['tax'], 'discount' => $subject['discount']];
                        } else {
                            return redirect()->route('admin.students.create')->with('error', 'مطلوب ادخال سعر لكل ماده')->with('data', $requests);
                        }
                    }
                }
            }

            $vendor = Vendor::create([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'password' => $request->password,
                'avatar' => $filePath,
                'mobile' => $request->mobile,
                'telephone_fix' => $request->telephone_fix,
                'email' => $request->email,
                'city' => $request->city,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'fb_student' => $request->fb_student,
                'fb_parent' => $request->fb_parent,
                'expire_date' => $request->expire_date,
                'major' => $request->major,
                'school'  => $request->school,
                'student_group' => $request->group,
                'user_type' => 22, // 22 mean student
                'active' => $request->active,
                'show_notes' => $request->show_notes,
                'notes' => $request->notes,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            if (!empty($subjects)){
                foreach ($subjects as $subject){
                    StudentsSubjects::create([
                        'subject_id' => $subject['subject'],
                        'student_id' => $vendor->id,
                        'subject_price' => $subject['price'],
                        'subject_tax'   => $subject['tax'],
                        'subject_discount' => $subject['discount'],
                    ]);
                }
            }
//            Notification::send($vendor, new VendorCreated($vendor));

            return redirect()->route('admin.students')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.students')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function edit($id)
    {
        try {

            $vendor = Vendor::find($id);
            if (!$vendor)
                return redirect()->route('admin.students')->with(['error' => 'هذا الطالب غير موجود او ربما يكون محذوفا ']);

            $categories = MainCategory::where('translation_of', 0)->active()->get();
            $majors = Major::all()->where('translation_lang', get_default_lang())->sortByDesc('id');
            $schools = SchoolsItems::all()->where('translation_lang', get_default_lang())->sortByDesc('school_id');
            $sc_years = Schoolyear::all()->where('translation_lang', get_default_lang())->sortByDesc('id');
            $subjects = Subjects::all()->where('translation_lang', get_default_lang())->sortByDesc('id');

            return view('admin.students.edit', compact('vendor', 'categories', 'majors', 'schools', 'sc_years', 'subjects'));
        } catch (\Exception $exception) {
            return redirect()->route('admin.students')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update(Request $request, $id)
    {

        try {

            $rules = [
                'avatar' => 'nullable|image',
                'fullname' => 'required|string',
                'username' => 'required|string',
                'mobile' => 'required|string',
                'telephone_fix' => 'nullable|string',
                'email' => 'required|email',
                'birthday' => 'required|date',
                'gender' => 'required|integer',
                'expire_date' => 'nullable|date',
                'city' => 'required|string',
                'password' => 'nullable',
                'fb_student' => 'nullable|url',
                'fb_parent' => 'nullable|url',
                'active' => 'nullable|integer',
                'show_notes' => 'nullable|integer',
                'notes'  => 'nullable|string',
                'major' => 'required|integer',
                'school' => 'nullable|integer',
                'group' => 'nullable|integer',
                'subject' => 'nullable|array',
                'subject.*' => 'nullable|array',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return redirect()->route('admin.students.edit', $id)->with('errors', $validator->messages()->get('*'));
            }

            $vendor = Vendor::all()->where('id', $id)->first();
            if (!$vendor)
                return redirect()->route('admin.students')->with(['error' => 'هذا الطالب غير موجود او ربما يكون محذوفا ']);

            DB::beginTransaction();

            if (Vendor::all()->where('username', $request->username)->where('id', '!=', $id)->count() > 0){
                return redirect()->route('admin.students.edit', $id)->with('errorUsername', 'اسم المستخدم مسجل بالفعل');
            }

            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            if (!$request->has('show_notes'))
                $request->request->add(['show_notes' => 0]);
            else
                $request->request->add(['show_notes' => 1]);

            $oldAvatar = $vendor->avatar;
            $filePath = null;
            if ($request->has('avatar')) {
                !empty($oldAvatar) && file_exists($oldAvatar) ? unlink($oldAvatar) : null;
                $filePath = uploadImage('vendors', $request->avatar);
            }

            $subjects = [];
            if (!empty($request->subject[0][0])){
                if (!empty($request->subject[0][0])){
                    $allSubjects = $request->subject;
                    foreach ($allSubjects as $subject){
                        if (isset($subject['price']) && !empty($subject['price'])) {
                            if (Subjects::find($subject[0]) === false)
                                return redirect('admin.students.edit', $vendor->id)->with('error', 'فشل فى اضافه المواد');
                            else
                                $subjects[] = ['subject' => $subject[0], 'price' => $subject['price'], 'tax' => $subject['tax'], 'discount' => $subject['discount']];
                        } else {
                            return redirect()->route('admin.students.edit', $vendor->id)->with('error', 'مطلوب ادخال سعر لكل ماده');
                        }
                    }
                }
            }

            $vendor->fullname = $request->fullname;
            $vendor->username = $request->username;
            $vendor->password = !empty($request->password) ? $request->password : $vendor->password;
            $vendor->avatar = !empty($filePath) ? $filePath : $oldAvatar;
            $vendor->mobile = $request->mobile;
            $vendor->telephone_fix = $request->telephone_fix;
            $vendor->email = $request->email;
            $vendor->city = $request->city;
            $vendor->birthday = $request->birthday;
            $vendor->gender = $request->gender;
            $vendor->fb_student = $request->fb_student;
            $vendor->fb_parent = $request->fb_parent;
            $vendor->expire_date = $request->expire_date;
            $vendor->major = $request->major;
            $vendor->school  = $request->school;
            $vendor->student_group = $request->group;
            $vendor->active = $request->active;
            $vendor->show_notes = $request->show_notes;
            $vendor->notes = $request->notes;

            if ($vendor->save()){
                // delete old subjects
                $oldSubject = StudentsSubjects::all()->where('student_id', $id);
                if (count($oldSubject)){
                    foreach ($oldSubject as $subject){
                        $subject->delete();
                    }
                }

                // put new subjects
                if (!empty($subjects)){
                    foreach ($subjects as $subject){
                        StudentsSubjects::create([
                            'subject_id' => $subject['subject'],
                            'student_id' => $vendor->id,
                            'subject_price' => $subject['price'],
                            'subject_tax'   => $subject['tax'],
                            'subject_discount' => $subject['discount'],
                        ]);
                    }
                }

                DB::commit();
                return redirect()->route('admin.students.edit', $id)->with(['success' => 'تم التحديث بنجاح']);
            } else {
                DB::commit();
                return redirect()->route('admin.students.edit', $id)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
            }

        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->route('admin.students.edit', $id)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function view($id){
        try{
            $categories = MainCategory::where('translation_of', 0)->active()->get();
            $vendor = DB::table('vendors')->select('vendors.*', 'schools_items.school_name')
                ->leftJoin('schools_items', 'schools_items.school_id', '=', 'vendors.school')
                ->where('vendors.id', $id)->first();
            if (empty($vendor)){
                return redirect()->route('admin.students')->with(['error' => 'الطالب غير موجود']);
            }

            return view('admin.students.view', compact('vendor', 'categories'));
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.students')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($id){
        try{
            $student = Vendor::find($id);
            if ($student === false){
                return redirect()->route('admin.students')->with(['error' => 'الطالب غير موجود']);
            }
            $avatar = $student->avatar;
            if (Vendor::where('id', $id)->delete()){
                !empty($avatar) && file_exists($avatar) ? unlink($avatar) : null;
            }
            return redirect()->route('admin.students')->with(['success' => 'تم حذف الطالب بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.students')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
