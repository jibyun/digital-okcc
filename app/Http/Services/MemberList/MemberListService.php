<?php

namespace App\Http\Services\MemberList;

/**
 * Service layer for handling member list
 */
class MemberListService
{
    function __construct() {
        
    }

    /**
     * Retrieve all members
     */
    public function getAllMembers() {
        // TODO: Implement the logic to get all member
        return '';
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
