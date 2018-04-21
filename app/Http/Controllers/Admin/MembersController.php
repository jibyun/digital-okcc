<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

use App\Member;

class MembersController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function start() {
        return view('admin.member');
    }

    public function index() {
        $members = Member::with(['codeByStatusId','codeByLevelId','codeByDutyId','codeByCityId','codeByProvinceId','codeByCountryId'])->orderBy('id', 'ASC')->get();
        $lists = array();
        foreach ($members as $value) {
            array_push($lists, $this->reinforceTable($value));
        }
        $result = array( "members" => json_decode( json_encode($lists), true ) );

        return response()->json($result);
    }

    public function store(Request $request) {
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
            $result = Member::create($input);
            return response()
                ->json([
                    'message' => 'The item was successfully created.',
                    'codes' => $result,
                    'status' => 200
                ], 200);
        }
    }

    public function update(Request $request, $id) {
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
                $result = $memberUpdate->fill($input)->save();
                return response()
                    ->json([
                        'message' => 'The item was successfully updated.',
                        'user' => $result,
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

    /**
     * Return reinforced table after adding elements and the name converted by code
     */
    private function reinforceTable($value) {
        $temp['id'] = $value->id;
        $temp['first_name'] = $value->first_name;
        $temp['middle_name'] = $value->middle_name;
        $temp['last_name'] = $value->last_name;
        $temp['kor_name'] = $value->kor_name;
        $temp['dob'] = $value->dob;
        $temp['gender'] = $value->gender;
        $temp['email'] = $value->email;
        $temp['tel_home'] = $value->tel_home;
        $temp['tel_office'] = $value->tel_office;
        $temp['tel_cell'] = $value->tel_cell;
        $temp['address'] = $value->address;
        $temp['postal_code'] = $value->postal_code;
        $temp['photo'] = $value->photo;
        $temp['city_id'] = $value->city_id;
        $temp['city_name'] = $value->codeByCityId->txt;
        $temp['province_id'] = $value->province_id;
        $temp['province_name'] = $value->codeByProvinceId->txt;
        $temp['country_id'] = $value->country_id;
        $temp['country_name'] = $value->codeByCountryId->txt;
        $temp['status_id'] = $value->status_id;
        $temp['status_name'] = $value->codeByStatusId->txt;
        $temp['level_id'] = $value->level_id;
        $temp['level_name'] = $value->codeByLevelId->txt;
        $temp['duty_id'] = $value->duty_id;
        $temp['duty_name'] = $value->codeByDutyId->txt;
        $temp['primary'] = $value->primary;
        $temp['register_at'] = $value->register_at;
        $temp['baptism_at'] = $value->baptism_at;
        return $temp;
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
