<?php

namespace App\Http\Services\MemberList;

use App\Member;

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
        $member = Member::all()->take(50);
        return $member;
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
     * Retrieve the member list belong to the given code
     * 
     * params: code code
     */
    public function getMemberList($code) {
        $field = $this->findFieldByCode($code);
        $member = Member::where($field, $code)->get();

    }

    /**
     * find the field name in member table by given code
     */
    private function findFieldNameByCode($code) {

    }

    /**
     * Search Category Sample
     */
    private function buildCategory() {
        // TEST BLOCK
        $myObj1 = (object)array();
        $myObj2 = (object)array();
        $myObj3 = (object)array();
        $myObj4 = (object)array();
        $myObj5 = (object)array();
        $myObj1->text = "교구";
        $myObj1->message = "This is the node1";
        $myObj2->text = "1교구";
        $myObj2->message = "This is the node2";
        $myObj3->text = "2교구";
        $myObj3->message = "Hello Dennis";
        $myObj4->text = "1구역";
        $myObj4->message = "Today is Tuesday";
        $myObj4->url = "all";
        $myObj5->text = "2구역";
        $myObj5->message = "Good Morning!!";
        $myObj5->url = "position";
        $myObj1->children = array($myObj2, $myObj3);
        $myObj2->children = array($myObj4, $myObj5);
        return $myObj1;
        // TEST BLOCK
    }
}
