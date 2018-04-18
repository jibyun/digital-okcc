<?php

namespace App\Http\Controllers\Rest\Util;

use App\User;
use App\Http\Controllers\Rest\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UtilsController extends BaseController
{

    public function __construct() {
    }

    /**
     * Display a listing of the search category.
     *
     * @return \Illuminate\Http\Response
     */
    public function addUser($id, $password)
    {
        $user = User::create([
            'name' => 'autouser',
            'email' => $id,
            'password' => Hash::make($password),
        ]);
        return $this->sendResponse('', "User created successfully.");
    }
}
