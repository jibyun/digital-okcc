<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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

    // The custom attributes 
    protected $appends = [
        'english_name','duty_txt','level_txt','status_txt','city_txt','province_txt','country_txt',
        'departments', 'positions'
    ];

    // Relationship with between codes table and city_id
    public function codeByCityId() {
        return $this->belongsTo('App\Code', 'city_id', 'id')->select('id', 'txt');
    } 

    // Relationship with between codes table and province_id
    public function codeByProvinceId() {
        return $this->belongsTo('App\Code', 'province_id', 'id')->select('id', 'txt');
    }

    // Relationship with between codes table and country_id
    public function codeByCountryId() {
        return $this->belongsTo('App\Code', 'country_id', 'id')->select('id', 'txt');
    }  

    // Relationship with between codes table and status_id
    public function codeByStatusId() {
        return $this->belongsTo('App\Code', 'status_id', 'id')->select('id', 'txt');
    }  

    // Relationship with between codes table and level_id
    public function codeByLevelId() {
        return $this->belongsTo('App\Code', 'level_id', 'id')->select('id', 'txt');
    }  

    // Relationship with between codes table and duty_id
    public function codeByDutyId() {
        return $this->belongsTo('App\Code', 'duty_id', 'id')->select('id', 'txt');
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
        return $this->hasMany('App\Family_Map','member_pri_id', 'id');
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

     // Relationship with family_maps table
     public function primaryMembers() {
        return $this->belongsToMany('App\Member', 'family_maps', 'member_sub_id', 'member_pri_id');
    }


    public function getEnglishNameAttribute() {
        return $this->attributes['first_name'].' '.$this->attributes['middle_name'].' '.$this->attributes['last_name'];
    }

    

    public function getCityTxtAttribute() {
        return $this->codeByCityId()->first()->txt;
    }

    public function getProvinceTxtAttribute() {
        return $this->codeByProvinceId()->first()->txt;
    }

    public function getCountryTxtAttribute() {
        return $this->codeByCountryId()->first()->txt;
    }

    public function getLevelTxtAttribute() {
        return $this->codeByLevelId()->first()->txt;
    }

    public function getStatusTxtAttribute() {
        return $this->codeByStatusId()->first()->txt;
    }

    public function getDutyTxtAttribute() {
        return $this->duty()->first()->txt;
    }

    /**
     * Return the comma seperated department string
     */
    public function getDepartmentsAttribute() {
        $departments = array();
        $member_department_maps = $this->member_department_maps()->get();
        if ($member_department_maps !== null) {
            foreach ($member_department_maps as $member_department_map) {
                array_push($departments, $member_department_map->department_txt);
            }
        }
        LOG::debug($departments);
        return implode(", ", $departments);
    }

    /**
     * Return the comma seperated position string
     */
    public function getPositionsAttribute() {
        $positions = array();
        $member_department_maps = $this->member_department_maps()->get();
        if ($member_department_maps !== null) {
            foreach ($member_department_maps as $member_department_map) {
                array_push($positions, $member_department_map->position_txt);
            }
        }
        LOG::debug($positions);
        return implode(", ", $positions);
    }

}
