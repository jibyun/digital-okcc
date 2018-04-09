<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code_Category extends Model
{
    // Table name: If table name is different from model name, it should need.
    protected $table = "code_categories";
    // Indicates if the model should be timestamped. 
    public $timestamps = false;
    // If non-incrementing or non-numeric primary key, false
    public $incrementing = true;
    // The attributes that are mass assignable.
    protected $fillable = [
        'id', 'txt', 'kor_txt', 'enabled', 'memo', 'order'
    ];

    // Relationship with codes table
    public function codes() {
        return $this->hasMany('App\Code');
    }

    
}
