<?php

namespace App\Http\Services\MemberList;

use App\Member;

/**
 * Service layer for handling Search request
 */
class SearchService
{
    function __construct() {
        
    }

    /**
     * Search the member and return the array
     * params: $search search string
     * 
     * return member list
     * 
     */
    public function getMemberList($search) {
        // TODO: At thie moment, we support the kor_name only.  We need to enhance the logic.
        $memberList = Member::where('kor_name', 'like', '%' . $search . '%')->get();
        return $memberList;
    }
}
