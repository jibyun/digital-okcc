<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    // Table name: If table name is different from model name, it should need.
    protected $table = "departments";
    // Indicates if the model should be timestamped. 
    public $timestamps = true;
    // If non-incrementing or non-numeric primary key, false
    public $incrementing = true;
    
    // Relationship with users table
    public function user() {
        return $this->belongsTo('App\User');
    }

    // Relationship with codes table
    public function code() {
        return $this->belongsTo('App\Code');
    }

    // Relationship with department_trees table
    public function department_trees() {
        return $this->hasMany('App\Department_Tree');
    }

    // Relationship with member_department_maps table
    public function member_department_maps() {
        return $this->hasMany('App\Member_Department_Map');
    }
}
