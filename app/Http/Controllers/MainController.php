<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class MainController extends Controller
{
    public function index() { 
        return view('MemberList/memberList');
    }

    public function memberList() { 
        return view('MemberList/memberList');
    }

    public function language() {
        /*
        |--------------------------------------------------------------------------
        | Localization for Javascript
        | This code is from 
        | https://medium.com/@serhii.matrunchyk/using-laravel-localization-with-javascript-and-vuejs-23064d0c210e
        |--------------------------------------------------------------------------
        */
        $strings = Cache::rememberForever('lang.js', function () {
            $lang = config('app.locale');
    
            $files   = glob(resource_path('lang/' . $lang . '/*.php'));
            $strings = [];
    
            foreach ($files as $file) {
                $name           = basename($file, '.php');
                $strings[$name] = require $file;
            }
    
            return $strings;
        });
    
        header('Content-Type: text/javascript');
        echo('window.i18n = ' . json_encode($strings) . ';');
        exit();
    }
}
