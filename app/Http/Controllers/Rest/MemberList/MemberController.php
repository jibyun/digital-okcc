<?php

namespace App\Http\Controllers\Rest\MemberList;

use Illuminate\Http\Request;
use App\Http\Controllers\Rest\BaseController;
use App\Http\Services\MemberList\MemberService;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Http\Services\Log\SystemLog;
use App\Member;


class MemberController extends BaseController
{
    private $TABLE_NAME = "MEMBERS";
    private $memberService;

    public function __construct() {
        $this->memberService = new MemberService();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //TODO
        return $this->sendResponse(json_encode($this->memberService->getMember($id)), "retrieved members successfully.");
    }

    public function edit(Request $request, $id) {
        $memberUpdate  = Member::findOrFail($id);
        $input = $request->all();
        $validator = \Validator::make( $input, $this->getRules(), $this->getMessages() );

        if ($validator->fails()) {
            return response()
                ->json([
                    'errors' => $validator->errors()->all(),
                    'message' => 'Failed',
                    'status' => 422
                ], 200);
        } else {
            try {
                $detail = SystemLog::createLogForUpdatedFields($memberUpdate, $input, 
                    ['city_name', 'province_name', 'country_name', 'status_name', 'level_name', 'duty_name']); 
                    $updetedMember=$memberUpdate->fill($input);
                    $result = $updetedMember->save();
                
                SystemLog::write(110004, $this->TABLE_NAME . ' [ID] ' . $id . ' [DETAIL] ' . $detail);
                return response()
                    ->json([
                        'message' => 'The item was successfully updated.',
                        'user' => $result,
                        'member'=>$updetedMember,
                        'status' => 200
                    ], 200);
            } catch (\Exception $exception) {
                return response()
                    ->json([
                        'errors' => $exception,
                        'message' => 'Failed',
                        'status' => 422
                    ], 200);
            }
        }
    }

    
    public function getCategory(Request $request)
    {
        //TODO
        $ids=$request->category_id;
        return $this->sendResponse(json_encode($this->memberService->getCategoryByIds($ids)), "retrieved members successfully.");
    }

    private function getRules() {
        return [
            'first_name'            => 'max:50',
            'middle_name'           => 'max:50',
            'last_name'             => 'max:50',
            'kor_name'              => 'max:50',
            'gender'                => [ 'required', Rule::in(['F', 'M']) ],
            'email'                 => 'max:255',
            "city_id"               => "sometimes|exists:codes,id",
            "province_id"           => "sometimes|exists:codes,id",
            "country_id"            => "sometimes|exists:codes,id",
            "status_id"             => "sometimes|exists:codes,id",
            "level_id"              => "sometimes|exists:codes,id",
            "duty_id"               => "sometimes|exists:codes,id",
        ];
    }

    private function getMessages() {
        return [

        ];
    }

}
