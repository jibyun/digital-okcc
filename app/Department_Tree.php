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
    // The attributes that are mass assignable.
    protected $fillable = [
        'id', 'parent_id', 'child_id'
    ];

    // Relationship with between codes table and parent_id
    public function codeByParentId() {
        return $this->belongsTo('App\Code', 'parent_id', 'id');
    }

    // Relationship with between codes table and child_id
    public function codeByChildId() {
        return $this->belongsTo('App\Code', 'child_id', 'id');
    }
}
