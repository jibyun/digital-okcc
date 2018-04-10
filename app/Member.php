<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    // Table name: If table name is different from model name, it should need.
    protected $table = "members";
    // Indicates if the model should be timestamped. 
    public $timestamps = true;
    // If non-incrementing or non-numeric primary key, false
    public $incrementing = true;
    
    // Relationship with codes table
    public function code() {
        return $this->belongsTo('App\Code');
    }

    // Relationship with users table
    public function users() {
        return $this->hasMany('App\User');
    }

    // Relationship with visits table
    public function visits() {
        return $this->hasMany('App\Visit');
    }

    // Relationship with family_maps table
    public function family_maps() {
        return $this->hasMany('App\Family_Map');
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
