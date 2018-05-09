<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use Illuminate\Exception;
use Carbon\Carbon;

use App\System_Log;

class LogController extends Controller {
    /**
     * Get log records by several conditions
     * @param date $from start date (default is current date)
     * @param date $to end date (default is current date)
     * @param int $code_id It says what kind of log will be saved. [110001] LOGIN [110002] LOGOUT [110003] INSERT [110004] UPDATE [110005] DELETE
     * @param int $user_id It says who made by
     */
    public function getLog(Request $request) {
        $to = empty($request->to) ? Carbon::parse(Carbon::today())->endOfDay() : Carbon::parse($request->to)->endOfDay();
        $from = empty($request->from) ? Carbon::parse(Carbon::today())->startOfDay() : Carbon::parse($request->from)->startOfDay();

        $query = System_Log::whereBetween('created_at', [$from, $to]);
        if ( !empty($request->code_id) ) {
            $query = $query->where('code_id', $request->code_id);
        }
        if ( !empty($request->user_id) ) {
            $query = $query->where('user_id', $request->user_id);
        }

        $lists = $query->with(['codeByCodeId','userByUserId'])->orderBy('created_at', 'DESC')->get();

        $result = array( "logs" => json_decode( json_encode($this->reinforceTable($lists)), true ) );
        return response()->json($result);
    }
    
    /**
     * Return reinforced table after adding elements and the name converted by code
     */
    private function reinforceTable( $lists ) {
        $result = array();
        foreach ($lists as $v) {
            $temp = [
                'id'            => $v->id,
                'code_id'       => $v->code_id,
                'code_name'     => $v->codeByCodeId->txt,
                'user_id'       => $v->user_id,
                'user_name'     => $v->userByUserId->name,
                'memo'          => $v->memo,
                'created_at'    => $v->created_at
            ];
            array_push($result, $temp);
        }
        return $result;
    }
}
