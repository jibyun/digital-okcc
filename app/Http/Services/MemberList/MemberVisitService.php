<?php

namespace App\Http\Services\MemberList;

use App\Member;
use App\Visit;
use App\Code_Category;
use App\Code;
use App\Member_Department_Map;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Service layer for handling member visitation
 */
class MemberVisitService
{
    // This is language setting and it is test purpose only.
    private $language = "EN";

    function __construct() {
    }

    /**
     * Retrieve all visitation by given member id
     */
    public function getVisitByMemberId($memberId) {
        $memberVisit = Visit::where('member_id', $memberId)->get();
        return $memberVisit;
    }

    /**
     * Create a new Visitation
     */
    public function createVisit($request) {
        LOG::debug($request);
        try {
            Visit::create($request->all());
            return 0;
        } catch (\Exception $e) {
            LOG::error($e->getMessage());
            return -1;
        }
    }

    /**
     * Update existing visitation
     */
    public function updateVisit($request, $id) {
        $existing = Visit::findOrFail($id);

        try {
            $existing->fill($request->all())->save();
            return 0;
        } catch (\Exception $e) {
            LOG::error($e->getMessage());
            return -1;
        }
    }

    /**
     * Delete existing visitation
     */
    public function deleteVisit($id) {
        LOG::debug($id);
        try {
            $result = Visit::where('id', $id)->delete();
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