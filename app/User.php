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

    /**
     * Return the JSON array of roles
     */
    public function roles() {
        $roles = array();
        $privilege = $this->privilege()->select('id')->first();
        if ($privilege !== null) {
            $privilege_role_maps = Privilege_Role_Map::with(['privilege', 'role'])
            ->where('privilege_id', $privilege->id)
            ->get();
            
            foreach ($privilege_role_maps as $privilege_role_map) {
                array_push($roles, $privilege_role_map->role->txt);
            }
        }
        return json_encode($roles);
    }

    /**
     * Check the current user has given role.
     * 
     * @return 1 if it has, otherwise emtpy.
     */
    public function hasRole($role) {
        $role_id = Role::where('txt', $role)->select('id')->first();
        return null !== $this->privilege()
                             ->whereHas('privilege_role_maps', function($query) use ($role_id) {
                                    $query -> where('role_id', $role_id->id);
                                })
                             ->first();
    }
}
