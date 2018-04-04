<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Privilege_Map extends Model
{
    // Table name: If table name is different from model name, it should need.
    protected $table = "user_privilege_maps";
    // Indicates if the model should be timestamped. 
    public $timestamps = true;
    // If non-incrementing or non-numeric primary key, false
    public $incrementing = true;
    
    // Relationship with privileges table
    public function privilege() {
        return $this->belongsTo('App\Privilege');
    }

    // Relationship with users table
    public function user() {
        return $this->belongsTo('App\User');
    }
}
