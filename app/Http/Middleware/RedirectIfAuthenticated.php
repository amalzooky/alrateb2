<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
//     public function handle($request, Closure $next, $guard = null)
//     {
//         if (Auth::guard($guard)->check()) {
//             if ($guard == 'admin')
//                 return redirect(RouteServiceProvider::ADMIN);
//             elseif($guard == 'sudent')
//                 return redirect(RouteServiceProvider::STUDENT);
//                 elseif($guard == 'teacher')
//                 return redirect(RouteServiceProvider::TEACHER);

//                 else
//                 return redirect(RouteServiceProvider::HOME);

//         }

//         return $next($request);
//     }
// }

public function handle($request, Closure $next, $guard = null)
{
    switch ($guard) {
        case 'admin':
            if (Auth::guard($guard)->check()) {
                return redirect()->route('get.admin.login');
            }
            break;
        case 'student':
            if (Auth::guard($guard)->check()) {
                return redirect()->route('get.student.login');
            }
            break;
     case 'teacher':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('get.teacher.login');
                }
                break;
        default:
            if (Auth::guard($guard)->check()) {
                return redirect('/home');
            }
            break;
    }
    return $next($request);
}
}