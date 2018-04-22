<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use Illuminate\Exception;
use Illuminate\Support\Carbon\Carbon;

use App\System_Log;

class LogController extends Controller {

    public function getLogAll($from, $to) {
        if ($to === null) { $to = Carbon::now(); }
        if ($from === null) { $from = Carbon::now(); }

        $lists = System_Log::whereBetween('created_at', [$from, $to])->with(['codeByCodeId','userByUserId'])->
            orderBy('created_at', 'DESC')->get();

        $result = array( "logs" => json_decode( json_encode($lists), true ) );
        return response()->json($result);
    }

    public function getLogByCode($code_id, $from, $to) {
        if ($to === null) { $to = Carbon::now(); }
        if ($from === null) { $from = Carbon::now(); }

        $lists = System_Log::whereBetween('created_at', [$from, $to])->where('code_id', $code_id)->with(['codeByCodeId','userByUserId'])->
            orderBy('created_at', 'DESC')->get();

        $result = array( "logs" => json_decode( json_encode($lists), true ) );
        return response()->json($result);
    }

    public function getLogByUser($user_id, $from, $to) {
        if ($to === null) { $to = Carbon::now(); }
        if ($from === null) { $from = Carbon::now(); }

        $lists = System_Log::whereBetween('created_at', [$from, $to])->where('user_id', $user_id)->with(['codeByCodeId','userByUserId'])->
            orderBy('created_at', 'DESC')->get();

        $result = array( "logs" => json_decode( json_encode($lists), true ) );
        return response()->json($result);
    }

    public function createLog($code_id, $memo) {
        $input = array( 'code_id' => $code_id, 'user_id' => \Auth::user()->id, 'memo' => $memo); // 11003: Insert, 11004: Update, 11005: Delete

        try {
            $result = System_Log::create($input);
            return response()->json( [
                    'message' => 'Successfully created a new log.',
                    'result' => $result,
                    'status' => 200 ], 200);
        } catch (Exception $ex) {
            return response()->json([
                    'errors' => $ex,
                    'message' => 'Not allowed to create!',
                    'status' => 405 ], 200);
        }
    }
        
    public function checkUpdatedFields($origin, $updated, $exceptArray) {
        $message = '';
        foreach ($updated as $key => $value) {
            if ( !isset($exceptArray) || (isset($exceptArray) && !in_array($key, $exceptArray))) {
                if ($value <> $origin[$key]) { // NEVER USER !=== 
                    $message .= '(' . $key . ') ' . $origin[$key] . ' > ' . $value . ', ';
                }
            }
        }
        return $message;
    }
}
