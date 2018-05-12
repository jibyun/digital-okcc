<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder {

    public function run() {
        DB::table('roles')->insert([ 'txt' => 'MEMBER_ACCESS_ROLE', 'memo' => "Members 메뉴를 보여준다." ]);
        DB::table('roles')->insert([ 'txt' => 'FINANCE_ACCESS_ROLE', 'memo' => "Finances 메뉴를 보여준다." ]);
        DB::table('roles')->insert([ 'txt' => 'INVENTORY_ACCESS_ROLE', 'memo' => "Inventory 메뉴를 보여준다." ]);
        DB::table('roles')->insert([ 'txt' => 'ADMIN_ACCESS_ROLE', 'memo' => "OKCC Cloud Office for Admin으로 접근할 수 있는 버튼을 보여준다." ]);
        DB::table('roles')->insert([ 'txt' => 'ADMIN_MEMBER_ROLE', 'memo' => "Admin Member 메뉴로의 접근을 허용한다." ]);
        DB::table('roles')->insert([ 'txt' => 'ADMIN_USER_ROLE', 'memo' => "Admin User 메뉴로의 접근을 허용한다." ]);
        DB::table('roles')->insert([ 'txt' => 'ADMIN_FINANCE_ROLE', 'memo' => "Admin Finance 메뉴로의 접근을 허용한다." ]);
        DB::table('roles')->insert([ 'txt' => 'ADMIN_INVENTORY_ROLE', 'memo' => "Admin Inventory 메뉴로의 접근을 허용한다." ]);
        DB::table('roles')->insert([ 'txt' => 'ADMIN_TEST_ROLE', 'memo' => "Admin Test 메뉴로의 접근을 허용한다." ]);
        DB::table('roles')->insert([ 'txt' => 'ADMIN_HOME_ROLE', 'memo' => "Admin에서 OKCC Cloud Office로 접근할 수 있는 버튼을 보여준다." ]);
        DB::table('roles')->insert([ 'txt' => 'ADMIN_SUPER_ROLE', 'memo' => "Super Admin 메뉴로의 접근을 허용한다." ]);

        DB::table('roles')->insert([ 'txt' => 'MEMBER_SIMBANG_ROLE', 'memo' => "Members 메뉴에서 심방 메뉴를 보여준다." ]);
    }
}
