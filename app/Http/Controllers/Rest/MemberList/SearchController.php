<?php

namespace App\Http\Controllers\Rest\MemberList;

use Illuminate\Http\Request;
use App\Http\Controllers\Rest\BaseController;
use App\Http\Services\MemberList\SearchService;

class SearchController extends BaseController
{
    private $searchService;

    public function __construct() {
        $this->searchService = new SearchService();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $search
     * @return \Illuminate\Http\Response
     */
    public function show($search)
    {
        return $this->sendResponse(json_encode($this->searchService->getMemberList($search)),
                                    "retrieved member successfully.");
    }

}
