<?php

namespace App\Http\Controllers\Rest\MemberList;

use App\Http\Controllers\Rest\BaseController;
use App\Http\Services\MemberList\MemberHistoryService;
use Illuminate\Http\Request;


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
        $result->members = $this->memberHistoryService->createHistory($request);
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
