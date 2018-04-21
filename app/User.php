<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'member_id', 'privilege_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relationship with system_logs table
    public function system_logs() {
        return $this->hasMany('App\System_Log');
    }

    // Relationship with member table
    public function member() {
        return $this->belongsTo('App\Member');
    }
    
    // Relationship with privilege table
    public function privilege() {
        return $this->belongsTo('App\Privilege');
    }

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
