<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use Illuminate\Exception;
use Illuminate\Support\Carbon\Carbon;

use App\System_Log;

class LogController extends Controller {

    public function getLog($from, $to, $code_id, $user_id) {
        if ( empty($to) ) { $to = Carbon::now(); }
        if ( empty($from) ) { $from = Carbon::now(); }

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

}
