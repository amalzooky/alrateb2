<?php

namespace App\Http\Controllers\Adminstudent;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginStudentRequest;

class LoginStudentsController extends Controller
{
    public function getLogin()
    {

        return view('student.Auth.login');
    }

    public function save()
    {


    }

    public function login(LoginStudentRequest $request)
    {

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('student')->attempt(
            [
                'username' => $request->input("username"),
                'password' => $request->input("password")
            ], $remember_me)) {
            // notify()->success('تم الدخول بنجاح  ');
            return redirect()->route('student.dashboard');
        }
        // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);
    }

//    public function logout()
//    {
//        //logout user
//        auth()->logout();
//        // redirect to homepage
//        return redirect('/login');
//    }
}
