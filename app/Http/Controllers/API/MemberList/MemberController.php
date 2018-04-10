<?php

namespace App\Http\Controllers\API\MemberList;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Http\Services\MemberList\MemberService;

class MemberController extends BaseController
{
    private $memberService;

    public function __construct() {
        $this->memberService = new MemberService();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //TODO
        return $this->sendResponse($id, "member retrieved successfully.");
    }

}
