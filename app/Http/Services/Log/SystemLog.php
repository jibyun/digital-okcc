<?php

namespace App\Http\Services\Log;

use Illuminate\Exception;
use App\System_Log;

class SystemLog {

    /**
     * Write a Log message to system_logs table
     * @param int $code_id It says what kind of log will be saved. [110001] LOGIN [110002] LOGOUT [110003] INSERT [110004] UPDATE [110005] DELETE
     * @param text $memo It says log messages.
     */
    public static function write($code_id, $memo) {
        switch ($code_id) {
            case 110001:
                $memo = 'LOGIN ' . $memo;   break;
            case 110002:
                $memo = 'LOGOUT ' . $memo;  break;
            case 110003:
                $memo = 'INSERT ' . $memo;  break;
            case 110004:
                $memo = 'UPDATE ' . $memo;  break;
            case 110005:
                $memo = 'DELETE ' . $memo;  break;
        }
        $input = array( 'code_id' => $code_id, 'user_id' => \Auth::user()->id, 'memo' => $memo);

        try {
            $result = System_Log::create($input);
            return response()->json( [
                    'message' => __('messages.log.success_message'),
                    'result' => $result,
                    'status' => 200 ], 200);
        } catch (Exception $ex) {
            return response()->json([
                    'errors' => $ex,
                    'message' => __('messages.log.error_message'),
                    'status' => 405 ], 200);
        }
    }

    /**
     * Create a log message for updated fields
     * @param array $origin a record before updated
     * @param array $updated a record after updated
     * @param array $except The fields in $except array will be excluded from comparision.
     */
    public static function createLogForUpdatedFields($origin, $updated, $except) {
        $message = '';
        foreach ($updated as $key => $value) {
            if ( !isset($except) || (isset($except) && !in_array($key, $except))) {
                if ($value <> $origin[$key]) { // NEVER USER !=== 
                    $message .= '(' . $key . ') ' . $origin[$key] . ' > ' . $value . ', ';
                }
            }
        }
        return $message;
    }
}
