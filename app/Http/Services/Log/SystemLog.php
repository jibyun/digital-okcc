<?php

namespace App\Http\Services\Log;

use Illuminate\Exception;
use Config;
use App\System_Log;

class SystemLog {

    /**
     * Write a Log message to system_logs table
     * @param int $code_id It says what kind of log will be saved. [110001] LOGIN [110002] LOGOUT [110003] INSERT [110004] UPDATE [110005] DELETE
     * @param text $memo It says log messages.
     */
    public static function write($code_id, $memo) {
        switch ($code_id) {
            case Config::get('app.admin.logLogin'):
                $memo = 'LOGIN ' . $memo;   break;
            case Config::get('app.admin.logLogOut'):
                $memo = 'LOGOUT ' . $memo;  break;
            case Config::get('app.admin.logInsert'):
                $memo = 'INSERT ' . $memo;  break;
            case Config::get('app.admin.logUpdate'):
                $memo = 'UPDATE ' . $memo;  break;
            case Config::get('app.admin.logDelete'):
                $memo = 'DELETE ' . $memo;  break;
        }
        $input = array( 'code_id' => $code_id, 'user_id' => \Auth::user()->id, 'memo' => $memo);

        try {
            return System_Log::create($input);
        } catch (Exception $ex) {
            return response()->json([ 'code' => 'exception', 'errors' => $e->getMessage(), 'status' => $e->getCode() ], 200);
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
