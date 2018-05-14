<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    // Table name: If table name is different from model name, it should need.
    protected $table = "visits";
    // Indicates if the model should be timestamped. 
    public $timestamps = true;
    // If non-incrementing or non-numeric primary key, false
    public $incrementing = true;
    
    // The attributes that are mass assignable.
    protected $fillable = [
        'id', 'member_id', 'started_at', 'paster_visitation', 'title', 'memo', 'updated_by'
    ];

    // Relationship with members table
    public function Member() {
        return $this->belongsTo('App\Member');
    }

    // Relationship with users table
    public function user() {
        return $this->belongsTo('App\User');
    }
}
