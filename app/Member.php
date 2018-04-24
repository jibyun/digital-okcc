<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {
    // Table name: If table name is different from model name, it should need.
    protected $table = "members";
    // Indicates if the model should be timestamped. 
    public $timestamps = true;
    // If non-incrementing or non-numeric primary key, false
    public $incrementing = true;
     // The attributes that are mass assignable.
     protected $fillable = [
        'id', 'first_name', 'middle_name', 'last_name', 'kor_name', 'dob', 'gender', 'email', 'tel_home', 'tel_office', 'tel_cell',
        'address', 'postal_code', 'photo', 'city_id', 'province_id', 'country_id', 'status_id', 'level_id', 'duty_id', 'primary',
        'register_at', 'baptism_at'
    ];

    // Relationship with between codes table and city_id
    public function codeByCityId() {
        return $this->belongsTo('App\Code', 'city_id', 'id');
    } 

    // Relationship with between codes table and province_id
    public function codeByProvinceId() {
        return $this->belongsTo('App\Code', 'province_id', 'id');
    }

    // Relationship with between codes table and country_id
    public function codeByCountryId() {
        return $this->belongsTo('App\Code', 'country_id', 'id');
    }  

    // Relationship with between codes table and status_id
    public function codeByStatusId() {
        return $this->belongsTo('App\Code', 'status_id', 'id');
    }  

    // Relationship with between codes table and level_id
    public function codeByLevelId() {
        return $this->belongsTo('App\Code', 'level_id', 'id');
    }  

    // Relationship with between codes table and duty_id
    public function codeByDutyId() {
        return $this->belongsTo('App\Code', 'duty_id', 'id');
    }  

    // Relationship with users table
    public function users() {
        return $this->hasMany('App\User');
    }

    // Relationship with visits table
    public function visits() {
        return $this->hasMany('App\Visit');
    }

    // Relationship with family_maps table
    public function family_maps() {
        return $this->hasMany('App\Family_Map');
    }

    // Relationship with member_department_maps table
    public function member_department_maps() {
        return $this->hasMany('App\Member_Department_Map');
    }

    // Relationship with member_histories table
    public function member_histories() {
        return $this->hasMany('App\Member_History');
    }

    // Relationship with member_department_maps table and get member_id and depatment_id
    public function departmentId() {
        return $this->hasMany('App\Member_Department_Map')->select('member_id', 'department_id');
    }

    // Get Duty by name
    public function duty() {
        return $this->belongsTo('App\Code', 'duty_id', 'id')->select('id', 'txt');
    }
}
