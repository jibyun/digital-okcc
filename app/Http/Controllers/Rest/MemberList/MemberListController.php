<?php

namespace App\Http\Controllers\Rest\MemberList;

use Illuminate\Http\Request;
use App\Http\Controllers\Rest\BaseController;
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
        // TODO: Error Handling
        return $this->sendResponse(json_encode($this->memberListService->getAllMembers()),
                                    "retrieved all members successfully.");
    }

    /**
     * Display the member list for the given code resource.
     *
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        // TODO: Error Handling
        return $this->sendResponse(json_encode($this->memberListService->getMemberList($code)), "retrieved members successfully.");
    }

    /**
     * Return the memberList settings as JSON
     * Settings contains
     *     Landing page bookmark
     *     Table Column info
     * 
     * @return \Illuminate\Http\Response
     */
    public function getSettings() {
        // TODO: Error Handling
        $settings = (object)array();
        $settings->bookmark = $this->memberListService->getBookmark();
        $settings->columninfos = $this->memberListService->getColumnInfos();
        return $this->sendResponse(json_encode($settings), "retrieved settings successfully.");
    }
}
