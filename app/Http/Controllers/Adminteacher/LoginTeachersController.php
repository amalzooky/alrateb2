<?php
namespace App\Http\Controllers\Adminteacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginTeacherRequest;
use App\Models\Teachers;
class LoginTeachersController extends Controller
{
    public function  getLogin(){

        return view('teacher.Auth.login');
    }

    public function save(){

    }

    public function login(LoginTeacherRequest $request){

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('teacher')->attempt(
            [
                'username' => $request->input("username"),
                'password' => $request->input("password")
            ], $remember_me)) {
            // notify()->success('تم الدخول بنجاح  ');
            return redirect() -> route('teacher.dashboard');
        }
        // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);


     
    }

    // public function logout () {
    //     //logout user
    //     auth()->logout();
    //     // redirect to homepage
    //     return redirect('/');
    // }
}
