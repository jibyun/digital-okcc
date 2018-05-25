<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member_Department_Map extends Model {
    // Table name: If table name is different from model name, it should need.
    protected $table = "member_department_maps";
    // Indicates if the model should be timestamped. 
    public $timestamps = true;
    // If non-incrementing or non-numeric primary key, false
    public $incrementing = true;
    // The attributes that are mass assignable.
    protected $fillable = [
        'id', 'member_id', 'department_id', 'position_id', 'enabled', 'updated_by', 'manager'
    ];
    // The custom attributes 
    protected $appends = ['department_txt', 'position_txt', 'is_manager_txt'];
    // Relationship with between members table and member_id
    public function memberByMemberId() {
        return $this->belongsTo('App\Member', 'member_id', 'id');
    }

    // Relationship with between codes (department code) table and department_id
    public function codeByDepartmentId() {
        return $this->belongsTo('App\Code', 'department_id', 'id');
    }

    // Relationship with between codes (position code) table and position_id
    public function codeByPositionId() {
        return $this->belongsTo('App\Code', 'position_id', 'id');
    }

    // Relationship with Users table
    public function userByUpdatedById() {
        return $this->belongsTo('App\User', 'updated_by', 'id');
    }

    // Relationship with members table
    public function membersByMemberId() {
        return $this->hasMany(App\Member::class);
    }
    

    //department txt
    public function getDepartmentTxtAttribute() {
        return $this->codeByDepartmentId()->first()->txt;
    }

    //Position txt
    public function getPositionTxtAttribute() {
        return $this->codeByPositionId()->first() ? $this->codeByPositionId()->first()->txt : '';
    }

     //department txt
     public function getIsManagerTxtAttribute() {
        return  $this->manager?'O':'X';
    }

   
   
}
