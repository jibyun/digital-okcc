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
     * Display the search result
     *
     * @param  string  $search
     * @return \Illuminate\Http\Response
     */
    public function show($search)
    {
        $result = (object)array();
        $result->members = $this->searchService->getMemberList($search);
        return $this->sendResponse(json_encode($result),
                                    "retrieved search result successfully.");
    }

}
