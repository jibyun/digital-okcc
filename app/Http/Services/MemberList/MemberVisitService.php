<?php

namespace App\Http\Services\MemberList;

use App\Visit;
use App\Http\Services\Log\SystemLog;
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
            $result = Visit::create($request->all());
            $logMessage = sprintf(__('messages.common.system_log_create'), (new Visit())->getTable(), $result->id);
            SystemLog::write('100003', $logMessage);
            return $result->id;
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
            $detail = SystemLog::createLogForUpdatedFields($existing, $request->all(), null); 
            $result = $existing->fill($request->all())->save();
            $logMessage = sprintf(__('messages.common.system_log_update'), (new Visit())->getTable(), $existing->id, $detail);
            SystemLog::write('100004', $logMessage);
            return $existing->id;
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
            $logMessage = sprintf(__('messages.common.system_log_delete'), (new Visit())->getTable(), $id);
            SystemLog::write('100005', $logMessage);
            return $result;
        } catch (\Exception $e) {
            LOG::error($e->getMessage());
            return -1;
        }
    }

    /**
     * Validate date
     */
    public function validate($request) {
        // Define rules
        $rules = [
            'title' => 'required|max:255',
            'visit_at' => 'required|date'
        ];

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->errors()->all();
        } else {
            return 1;
        }
    }
}