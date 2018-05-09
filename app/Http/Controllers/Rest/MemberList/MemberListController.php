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
        $result = (object)array();
        $result->members = $this->memberListService->getAllMembers();
        return $this->sendResponse(json_encode($result),
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
        $result = (object)array();
        $result->managerInfo = $this->memberListService->getManagerInfo($code);
        $result->members = $this->memberListService->getMemberList($code);

        return $this->sendResponse(json_encode($result), "retrieved members successfully.");
    }

    /**
     * Return the memberList settings as JSON
     * Settings contains
     *     Landing page bookmark
     *     Table Column info
     *     List of Member Status
     * 
     * @return \Illuminate\Http\Response
     */
    public function getSettings() {
        $settings = (object)array();
        $settings->bookmark = $this->memberListService->getBookmark();
        $settings->columninfos = $this->memberListService->getColumnInfos();
        $settings->memberStatus = $this->memberListService->getMemberStatus();
        return $this->sendResponse(json_encode($settings), "retrieved settings successfully.");
    }
}
