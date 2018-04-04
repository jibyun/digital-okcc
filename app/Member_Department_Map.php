<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member_Department_Map extends Model
{
    // Table name: If table name is different from model name, it should need.
    protected $table = "member_department_maps";
    // Indicates if the model should be timestamped. 
    public $timestamps = true;
    // If non-incrementing or non-numeric primary key, false
    public $incrementing = true;
    
    // Relationship with members table
    public function member() {
        return $this->belongsTo('App\Member');
    }

    // Relationship with codes table
    public function code() {
        return $this->belongsTo('App\Code');
    }

    // Relationship with departments table
    public function department() {
        return $this->belongsTo('App\Department');
    }

    // Relationship with Users table
    public function user() {
        return $this->belongsTo('App\User');
    }
}
