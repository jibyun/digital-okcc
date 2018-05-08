<?php

namespace App\Http\Services\MemberList;

use App\Member;
use App\Member_History;
use App\Code_Category;
use App\Code;
use App\Member_Department_Map;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Service layer for handling member history
 */
class MemberHistoryService
{
    // This is language setting and it is test purpose only.
    private $language = "EN";

    function __construct() {
    }

    /**
     * Retrieve all history by given member id
     */
    public function getHistoryByMemberId($memberId) {
        $memberHistory = Member_History::where('member_id', $memberId)->get();
        return $memberHistory;
    }

    /**
     * Create a new History
     */
    public function createHistory($memberId) {
        $memberHistory = Member_History::where('member_id', $memberId)->get();
        return $memberHistory;
    }

    /**
     * Update existing history
     */
    public function updateHistory($id) {
        $memberHistory = Member_History::where('member_id', $memberId)->get();
        return $memberHistory;
    }

    /**
     * Delete existing history
     */
    public function deleteHistory($id) {
        $result = Member_History::where('id', $id)->delete();
        return $result;
    }

    /**
     * Validate date
     */
    private function validate() {
        
    }
}