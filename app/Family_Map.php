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
    // The attributes that are mass assignable.
    protected $fillable = [
        'id', 'member_pri_id', 'member_sub_id', 'relation_id'
    ];

    // Relationship with between members table and member_pri_id
    public function memberByParentId() {
        return $this->belongsTo('App\Member', 'member_pri_id', 'id');
    }

    // Relationship with between members table and member_sub_id
    public function memberByChildId() {
        return $this->belongsTo('App\Member', 'member_sub_id', 'id');
    }

    // Relationship with codes table
    public function codeByRelationId() {
        return $this->belongsTo('App\Code', 'relation_id', 'id');
    }
}
