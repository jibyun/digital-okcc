<?php

namespace App\Http\Controllers\API\MemberList;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Http\Services\MemberList\MemberListService;

class MemberListController extends BaseController
{
    private $memberListService;

    public function __construct() {
        $this->memberListService = new MemberListService();
    }
    /**
     * Display a listing of all members.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendResponse(json_encode([$this->memberListService->getAllMembers()]),
                                    "retrieved all members successfully.");
    }

    /**
     * Display the member list for the given code resource.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        // TODO: need to implement the service layer logic to get member list
        return $this->sendResponse($code, "retrieved members successfully.");
    }
}
