<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuestController extends Controller
{
      //
      public function apply(Request $request)
      {
         $name=$request->name;
          //to do: 가입하신 분의 정보를 어떻게 처리할 것인지
          return view('completed_apply')->with('name', $name);
      }
}
