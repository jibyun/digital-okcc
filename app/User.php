<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relationship with user_privilege_maps table
    public function user_privilege_maps() {
        return $this->hasMany('App\User_Privilege_Map');
    }

    // Relationship with system_logs table
    public function system_logs() {
        return $this->hasMany('App\System_Log');
    }

    // Relationship with members table
    // public function members() {
    //     return $this->hasMany('App\Member');
    // }

    // Relationship with visits table
    public function visits() {
        return $this->hasMany('App\Visit');
    }

    // Relationship with memos table
    public function memos() {
        return $this->hasMany('App\Memo');
    }

    // Relationship with member_department_maps table
    public function member_department_maps() {
        return $this->hasMany('App\Member_Department_Map');
    }

    // Relationship with member_histories table
    public function member_histories() {
        return $this->hasMany('App\Member_History');
    }
}
