<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Config;

use App\User;
use App\Member;
use App\Privilege;
use App\Http\Services\Log\SystemLog;

class UsersController extends Controller {
    private $TABLE_NAME = "USERS";

    public function __construct() {
        $this->middleware('auth', ['except' => ['getUsers']]);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // find a record from users by id
        $userUpdate  = User::findOrFail($id);
        $input = $request->all();
        $validator = \Validator::make( $input, [
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|max:255|unique:users,email,'.$id,
            'password'              => '',
            'member_id'             => '',
            'privilege_id'          => ''
        ], [
            'name.required'         => 'The user name field can not be blank.',
            'email.required'        => 'The email field can not be blank.',
        ]);

        if ($validator->fails()) {
            return response()->json([ 'code' => 'validation', 'errors' => $validator->errors()->all() ], 200);
        } else {
            try {
                $detail = SystemLog::createLogForUpdatedFields($userUpdate, $input, ['member_name', 'privilege_name']);
                $user = $userUpdate->fill($input)->save();
                SystemLog::write(Config::get('app.admin.logUpdate'), $this->TABLE_NAME . ' [ID] ' . $id . ' [DETAIL] ' . $detail);
                return response()->json([ 'user' => $user ], 200);
            } catch (Exception $e) {
                return response()->json([ 'code' => 'exception', 'errors' => $e->getMessage(), 'status' => $e->getCode() ], 200);
            }
        }
    }

    /**
     * Get users with the information of member and privilege
     */
    public function getUsers(Request $request) {
        if ($request->table == 'users') {
            $userArray = User::with(['member','privilege'])->orderBy('id', 'ASC')->get();
            $arr = array();
            foreach ($userArray as $value) {
                array_push($arr, $this->reinforceTable($value));
            }
            $result = array("users" => json_decode(json_encode($arr), true));
        } else if ($request->table == 'members') {
            $memberArray = Member::orderBy('first_name', 'ASC')->orderBy('last_name', 'ASC')->get();
            $arr = array();
            foreach ($memberArray as $value) {
                array_push($arr, $this->reinforceMember($value));
            }
            $result = array("members" => $arr);
        } else if ($request->table == 'householders') {
            $memberArray = Member::where('primary', 1)->orderBy('first_name', 'ASC')->orderBy('last_name', 'ASC')->get();
            $arr = array();
            foreach ($memberArray as $value) {
                array_push($arr, $this->reinforceMember($value));
            }
            $result = array("members" => $arr);
        } else if ($request->table == 'family') {
            $memberArray = Member::where('primary', 0)->orderBy('first_name', 'ASC')->orderBy('last_name', 'ASC')->get();
            $arr = array();
            foreach ($memberArray as $value) {
                array_push($arr, $this->reinforceMember($value));
            }
            $result = array("members" => $arr);
        } else { // privilege
            $privilegeArray = Privilege::get();
            $arr = array();
            foreach ($privilegeArray as $value) {
                array_push($arr, $this->reinforcePrivilege($value));
            }
            $result = array("privileges" => json_decode(json_encode($arr), true));
        }
        
        return response()->json($result);
    }

    public function getCurrentUsers() {
        $user = \Auth::user();
        $result = array("user" => json_decode(json_encode($user), true));
        return response()->json($result);
    }

    /**
     * Return reinforced table after adding elements and the name converted by code
     */
    private function reinforceTable($v) {
        $tmp['id'] = $v->id;
        $tmp['name'] =  $v->name;
        $tmp['email'] =  $v->email;
        $tmp['member_id'] =  $v->member->id;
        if (!trim($v->member->first_name) && !trim($v->member->last_name)) {
            $tmp['member_name'] = $v->member->kor_name;
        } else {
            $tmp['member_name'] = !trim($v->member->first_name) ? trim($v->member->last_name) : trim($v->member->first_name) . ' ' . trim($v->member->last_name);
        }
        $tmp['privilege_id'] =  $v->privilege->id;
        $tmp['privilege_name'] =  $v->privilege->txt;

        return $tmp;
    }
    
    /**
     * Return reinforced table after adding elements and the name converted by code
     */
    private function reinforceMember($v) {
        $tmp['idx'] = $v->id;
        if (!trim($v['first_name']) && !trim($v['last_name'])) {
            $tmp['label'] = $v['kor_name'];
        } else {
            $tmp['label'] = !trim($v['first_name']) ? trim($v['last_name']) : trim($v['first_name']) . ' ' . trim($v['last_name']);
            $tmp['label'] .= ' (' . $v['kor_name'] . ')';
        }
        $tmp['kor_name'] = $v->kor_name;
        $tmp['tel_home'] = $v->tel_home;
        $tmp['tel_office'] = $v->tel_office;
        return $tmp;
    }
        
    /**
     * Return reinforced table after adding elements and the name converted by code
     */
    private function reinforcePrivilege($v) {
        $tmp['idx'] = $v->id;
        $tmp['label'] = $v->txt;

        return $tmp;
    }
}
