<?php

namespace App\Http\Services\MemberList;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Service layer for handling member list
 */
class MemberListService
{
    function __construct() {
        
    }

    /**
     * Retrieve the search category from DB
     * 전교인/직분/기관부서/구역 등등
     */
    public function getCategory() {

        $category = $this->buildCategory();
        return $category;
    }

    /**
     * Search Category Sample
     */
    private function buildCategory() {
    }
}
