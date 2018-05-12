<?php

use Illuminate\Database\Seeder;

class PrivilegesTableSeeder extends Seeder {

    public function run() {
        DB::table('privileges')->insert([ 
            'txt' => 'SYSTEM_ADMIN', 
            'memo' => "The privilege has the authority of the super administrator."
        ]);
        DB::table('privileges')->insert([ 
            'txt' => 'SENIOR_PASTOR', 
            'memo' => "담임목사: Member와 Member Admin의 대부분 메뉴에 접근 가능함."
        ]);
        DB::table('privileges')->insert([ 
            'txt' => 'ASSOCIATE_PASTOR', 
            'memo' => "부목사: Member의 전체 검색 기능과 심방 메뉴에 접근 가능함."
        ]);
        DB::table('privileges')->insert([ 
            'txt' => 'PASTOR', 
            'memo' => "담당목사: Member의 전체 검색 기능에 접근 가능함"
        ]);
        DB::table('privileges')->insert([ 
            'txt' => 'CLERK', 
            'memo' => "사무원: Member와 Member Admin의 대부분 메뉴에 접근 가능함 (담임목사 Priviege와 동일함)"
        ]);
        DB::table('privileges')->insert([ 
            'txt' => 'BOD', 
            'memo' => "집사회: Member의 전체 검색 기능에 접근 가능함 (담당목사 Privilege와 동일함)"
        ]);
    }
}
