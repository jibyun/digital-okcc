<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department_Tree extends Model
{
    // Table name: If table name is different from model name, it should need.
    protected $table = "department_trees";
    // Indicates if the model should be timestamped. 
    public $timestamps = false;
    // If non-incrementing or non-numeric primary key, false
    public $incrementing = true;
    
    // Relationship with departments table
    public function department() {
        return $this->belongsTo('App\Department');
    }
}
