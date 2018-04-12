<?php

use Illuminate\Database\Seeder;

class PrivilegesTableSeeder extends Seeder {

    public function run() {
        DB::table('privileges')->insert([ 
            'txt' => 'SYSTEM_ADMIN', 
            'memo' => "<p>The privilege has the authority of the super administrator.</p>"
        ]);
        DB::table('privileges')->insert([ 
            'txt' => 'SENIOR_PASTOR', 
            'memo' => "<p>The privilege has all authorities except user's management menu.</p>"
        ]);
        DB::table('privileges')->insert([ 
            'txt' => 'ASSOCIATE_PASTOR', 
            'memo' => "<p>The privilege has authorities of search_all in Members menu and as pastrol invitaton.</p>"
        ]);
        DB::table('privileges')->insert([ 
            'txt' => 'PASTOR', 
            'memo' => "<p>The privilege has authorities of search_all in Members.</p>"
        ]);
        DB::table('privileges')->insert([ 
            'txt' => 'CLERK', 
            'memo' => "<p>The privilege has same authorities with senior pastor.</p>"
        ]);
        DB::table('privileges')->insert([ 
            'txt' => 'BOD', 
            'memo' => "<p>The privilege has authorities of search_all in Members.</p>"
        ]);
    }
}
