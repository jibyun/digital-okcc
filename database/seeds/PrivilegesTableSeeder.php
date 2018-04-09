<?php

use Illuminate\Database\Seeder;

class PrivilegesTableSeeder extends Seeder {

    public function run() {
        DB::table('privileges')->insert([ 
            'txt' => 'Member', 
            'memo' => "<p>The privilege means that someone with the privilege can use Members application.</p>"
        ]);
        DB::table('privileges')->insert([ 
            'txt' => 'Finance', 
            'memo' => "<p>The privilege means that someone with the privilege can use Finance application.</p>"
        ]);
        DB::table('privileges')->insert([ 
            'txt' => 'Inventory', 
            'memo' => "<p>The privilege means that someone with the privilege can use Inventories application.</p>"
        ]);
    }
}
