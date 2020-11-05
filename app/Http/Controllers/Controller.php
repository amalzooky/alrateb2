<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // for only admin base route
        $notAllowedPathToGo = 'admin/not-allowed';
        $routesAllowed = [
            'admin',
            'admin/login',
            'admin/logout',
        ];
        // allow check
        $checkPrivileges = session()->exists('privileges') && session()->get('privileges') != null;
        // get your routes that allowed and push it in {$routesAllowed} array
        $myRoutesArray = $checkPrivileges ? unserialize(session()->get('privileges')) : null;
        // push your routes array in our {$routeAllowed} array
        array_push($routesAllowed, $myRoutesArray);
        // get route base name
        $routeBaseName = explode('/', trim(request()->path(), '/'))[0];
        // do check
        if ($checkPrivileges
            && $routeBaseName === 'admin'
            && request()->method() === 'GET'
            && !in_array(request()->path(), $routesAllowed)
            && request()->path() !== $notAllowedPathToGo){
            return redirect()->to($notAllowedPathToGo)->send();
        }
    }
}
