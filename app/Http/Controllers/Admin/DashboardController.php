<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use DB;

class DashboardController extends Controller
{
    public function index(){
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_lang', $default_lang)
            ->selection()
            ->get();

        return view('admin.dashboard', compact('categories'));
    }

    public function sidebar(){
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_lang', $default_lang)
            ->selection()
            ->get();
//        $categories = MainCategory::all();
        return view('admin.includes.sidebar', compact('categories'));
    }



    }

