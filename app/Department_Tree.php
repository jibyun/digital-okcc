<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Department_Tree extends Model
{
    // Table name: If table name is different from model name, it should need.
    protected $table = "department_trees";
    // Indicates if the model should be timestamped. 
    public $timestamps = false;
    // If non-incrementing or non-numeric primary key, false
    public $incrementing = true;
    
    // Relationship with codes table
    public function code() {
        return $this->belongsTo('App\Code');
    }
}
