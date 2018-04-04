<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    // Table name: If table name is different from model name, it should need.
    protected $table = "memos";
    // Indicates if the model should be timestamped. 
    public $timestamps = true;
    // If non-incrementing or non-numeric primary key, false
    public $incrementing = true;
    
    // Relationship with users table
    public function user() {
        return $this->belongsTo('App\User');
    }
}
