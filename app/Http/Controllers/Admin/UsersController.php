<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Member;
use App\Privilege;

class UsersController extends Controller {

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
            return response()
                ->json([
                    'errors' => $validator->errors()->all(),
                    'message' => 'Failed',
                    'status' => 422
                ], 200);
        } else {
            try {
                $user = $userUpdate->fill($input)->save();
                return response()
                    ->json([
                        'message' => 'Successfully created a new account.',
                        'user' => $user,
                        'status' => 200
                    ], 200);
            } catch (\Exception $exception) {
                logger()->error($exception);
                return response()
                    ->json([
                        'errors' => $exception,
                        'message' => 'Failed',
                    ], 200);
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
        }

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
