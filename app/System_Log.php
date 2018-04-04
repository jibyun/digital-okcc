<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System_Log extends Model
{
    // Table name: If table name is different from model name, it should need.
    protected $table = "system_logs";
    // Indicates if the model should be timestamped. 
    public $timestamps = true;
    // If non-incrementing or non-numeric primary key, false
    public $incrementing = true;
    
    // Relationship with codes table
    public function code() {
        return $this->belongsTo('App\Code');
    }

    // Relationship with users table
    public function user() {
        return $this->belongsTo('App\User');
    }
}
