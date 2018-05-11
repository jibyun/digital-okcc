<?php

namespace App\Http\Controllers\Rest\MemberList;

use App\Http\Controllers\Rest\BaseController;
use App\Http\Services\MemberList\MemberHistoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class MemberHistoryController extends BaseController
{
    private $memberHistoryService;

    public function __construct() {
        $this->memberHistoryService = new MemberHistoryService();
    }

    /**
     * Display a listing of the member history.
     *
     * @param member ID
     * @return \Illuminate\Http\Response
     */
    public function list($memberId)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$result = (object)array();
        //$result->members = $this->memberHistoryService->createHistory($request);
        // Check validation
        $result = $this->memberHistoryService->createHistory($request);
        if ($result == 0) {
            //LOG::debug("This is message from : " . $result->members);
            return $this->sendResponse("SUCCESS", "Member history created", 200);
        } else {
            return $this->sendError("ERROR", "Error creating member history", 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
