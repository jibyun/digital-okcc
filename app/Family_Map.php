<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family_Map extends Model
{
    // Table name: If table name is different from model name, it should need.
    protected $table = "family_maps";
    // Indicates if the model should be timestamped. 
    public $timestamps = false;
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
}
