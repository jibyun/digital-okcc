<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth;
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

    public function createLog($code_id, $user_id, $memo) {
        $input->code_id = $code_id;
        $input->user_id = $user_id;
        $input->memo = $memo;

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
}
