<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    // Table name: If table name is different from model name, it should need.
    protected $table = "privileges";
    // Indicates if the model should be timestamped. 
    public $timestamps = true;
    // If non-incrementing or non-numeric primary key, false
    public $incrementing = true;
    
    // Relationship with privilege_role_maps table
    public function privilege_role_maps() {
        return $this->hasMany('App\Privilege_Role_Map');
    }

    // Relationship with user_privilege_maps table
    public function user_privilege_maps() {
        return $this->hasMany('App\User_Privilege_Map');
    }
}
