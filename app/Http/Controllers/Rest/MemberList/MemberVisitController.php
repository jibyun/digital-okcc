<?php

namespace App\Http\Controllers\Rest\MemberList;

use App\Http\Controllers\Rest\BaseController;
use App\Http\Services\MemberList\MemberVisitService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class MemberVisitController extends BaseController
{
    private $memberVisitService;

    public function __construct() {
        $this->memberVisitService = new MemberVisitService();
    }

    /**
     * Display a listing of the member visitation.
     *
     * @param member ID
     * @return \Illuminate\Http\Response
     */
    public function list($memberId)
    {
        $result = (object)array();
        $result->visit = $this->memberVisitService->getVisitByMemberId($memberId);
        return $this->sendResponse(json_encode($result),
                                    "retrieved member visitation successfully.");
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
        // Check validation
        $result = $this->memberVisitService->createVisit($request);
        if ($result == 0) {
            //LOG::debug("This is message from : " . $result->members);
            return $this->sendResponse("SUCCESS", "Member Visitation created", 200);
        } else {
            return $this->sendError("ERROR", "Error creating member visitation", 500);
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
        $result = $this->memberVisitService->updateVisit($request, $id);
        if ($result == 0) {
            //LOG::debug("This is message from : " . $result->members);
            return $this->sendResponse("SUCCESS", "Member visitation updated", 200);
        } else {
            return $this->sendError("ERROR", "Error updating member visitation", 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->memberVisitService->deleteVisit($id);
        if ($result >= 0) {
            return $this->sendResponse("SUCCESS", "Member visitation removed", 200);
        } else {
            return $this->sendError("ERROR", "Error removing member visitation", 500);
        }
    }
}
