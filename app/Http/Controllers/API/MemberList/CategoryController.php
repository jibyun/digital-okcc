<?php

namespace App\Http\Controllers\API\MemberList;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Http\Services\MemberList\MemberListService;

class CategoryController extends BaseController
{
    private $memberListService;

    public function __construct() {
        $this->memberListService = new MemberListService();
    }

    /**
     * Display a listing of the search category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendResponse(json_encode([$this->memberListService->getCategory()]),
                                   "Category retrieved successfully.");
    }
}
