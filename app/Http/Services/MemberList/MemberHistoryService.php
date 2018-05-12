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
    public function createHistory($request) {
        LOG::debug($request);
        try {
            Member_History::create($request->all());
            return 0;
        } catch (\Exception $e) {
            LOG::error($e->getMessage());
            return -1;
        }
    }

    /**
     * Update existing history
     */
    public function updateHistory($request, $id) {
        $existing = Member_History::findOrFail($id);

        try {
            $existing->fill($request->all())->save();
            return 0;
        } catch (\Exception $e) {
            LOG::error($e->getMessage());
            return -1;
        }
    }

    /**
     * Delete existing history
     */
    public function deleteHistory($id) {
        LOG::debug($id);
        try {
            $result = Member_History::where('id', $id)->delete();
            return $result;
        } catch (\Exception $e) {
            LOG::error($e->getMessage());
            return -1;
        }
    }

    /**
     * Validate date
     */
    private function validate() {
        
    }
}