<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System_Log extends Model {
    // Table name: If table name is different from model name, it should need.
    protected $table = "system_logs";
    // Indicates if the model should be timestamped. 
    public $timestamps = false;
    // If non-incrementing or non-numeric primary key, false
    public $incrementing = true;
    // The attributes that are mass assignable.
    protected $fillable = [ 'id', 'code_id', 'user_id', 'memo', 'created_at' ];

    // Relationship with codes table
    public function codeByCodeId() {
        return $this->belongsTo('App\Code', 'code_id', 'id');
    }

    // Relationship with users table
    public function userByUserId() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
