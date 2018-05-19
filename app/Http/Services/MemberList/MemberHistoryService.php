<?php

namespace App\Http\Services\MemberList;

use App\Member_History;
use App\Http\Services\Log\SystemLog;
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
            $result = Member_History::create($request->all());
            $logMessage = sprintf(__('messages.common.system_log_create'), (new Member_History())->getTable(), $result->id);
            SystemLog::write('100003', $logMessage);
            return $result->id;
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
            $detail = SystemLog::createLogForUpdatedFields($existing, $request->all(), null); 
            $result = $existing->fill($request->all())->save();
            $logMessage = sprintf(__('messages.common.system_log_update'), (new Member_History())->getTable(), $existing->id, $detail);
            SystemLog::write('100004', $logMessage);
            return $existing->id;
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
            $logMessage = sprintf(__('messages.common.system_log_delete'), (new Member_History())->getTable(), $id);
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
            'started_at' => 'required|date',
            'finished_at' => 'nullable|date|after:started_at'
        ];

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            LOG::error($validator->errors()->all());
            return $validator->errors()->all();
        } else {
            return 1;
        }
    }
}