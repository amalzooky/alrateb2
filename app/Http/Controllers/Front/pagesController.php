<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class pagesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view ('front.pages.home');

    }

    // login
    public function login()
    {
        if (auth()->guard('student')->check())
            return redirect('/student');
        elseif (auth()->guard('teacher')->check())
            return redirect('/teacher');
        elseif (auth()->guard('admin')->check())
            return redirect('/admin');
        // else
        return view ('front.pages.login.login');
    }

    // logout
    public function logout()
    {
        // logout all types of users
        auth('student')->logout();
        auth('teacher')->logout();
        auth('admin')->logout();
        // redirect to login
        return redirect('/login');
    }
    public function aboutus()
    {
        return view ('front.pages.about');

    }

    public function gallery()
    {
        return view ('front.pages.gallery');

    }
    public function actives()
    {
        return view ('front.pages.actives');

    }
    public function contactus()
    {
        return view ('front.pages.contactus');

    }
    public function saidus()
    {
        return view ('front.pages.saidabout');

    }
    public function honor()
    {
        return view ('front.pages.Honor');

    }
    
   
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
