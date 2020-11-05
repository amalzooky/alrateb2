<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Request;
use Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
//            if (Route::is('admin.*')) {
//                return route('get.admin.login');
//            } elseif (Route::is('student.*')) {
//                return route('get.student.login');
//            } elseif (Route::is('teacher.*')) {
//                return route('get.teacher.login');
//            } else {
//                return route('login');
//            }
            if(Route::is('admin.*') || Route::is('student.*') || Route::is('teacher.*')){
                return route('login');
            }
        }
    }
}
