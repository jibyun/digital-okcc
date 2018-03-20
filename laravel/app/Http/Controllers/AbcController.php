<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AbcController extends Controller
{
    public function index()
    {
        return view('Abc/index');
    }
}
