<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privilege_Role_Map extends Model
{
    // Table name: If table name is different from model name, it should need.
    protected $table = "privilege_role_maps";
    // Indicates if the model should be timestamped. 
    public $timestamps = true;
    // If non-incrementing or non-numeric primary key, false
    public $incrementing = true;
    // The attributes that are mass assignable.
    protected $fillable = [
        'id', 'privilege_id', 'role_id'
    ];

    // Relationship with privileges table
    public function privilege() {
        return $this->belongsTo('App\Privilege');
    }

    // Relationship with roles table
    public function role() {
        return $this->belongsTo('App\Role');
    }
}
