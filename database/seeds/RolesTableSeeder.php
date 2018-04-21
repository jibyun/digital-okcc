<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder {

    public function run() {
        DB::table('roles')->insert([ 'txt' => 'SUPER_ADMIN_ROLE', 'memo' => "<p>All features are allowed.</p>" ]);
        DB::table('roles')->insert([ 'txt' => 'MEMBER_ADMIN_ROLE', 'memo' => "<p>All features of Members menu and limited features of Admin menu are allowed.</p>" ]);
        DB::table('roles')->insert([ 'txt' => 'MEMBER_SIMBANG_ROLE', 'memo' => "<p>All pastrol invitation features of Members menu are allowed.</p>" ]);
        DB::table('roles')->insert([ 'txt' => 'MEMBER_SEARCH_ALL_ROLE', 'memo' => "<p>All searching features of Members menu are allowed.</p>" ]);
        DB::table('roles')->insert([ 'txt' => 'MEMBER_SEARCH_BELONGTO_ROLE', 'memo' => "<p>Only members of the group to which you belong can be searched.</p>" ]);
        DB::table('roles')->insert([ 'txt' => 'FINANCE_ADMIN_ROLE', 'memo' => "<p>All features of Finance menu and limited features of Admin menu are allowed.</p>" ]);
        DB::table('roles')->insert([ 'txt' => 'INVENT_ADMIN_ROLE', 'memo' => "<p>All features of Inventories menu and limited features of Admin menu are allowed.</p>" ]);
        DB::table('roles')->insert([ 'txt' => 'NONE', 'memo' => "<p>No access is allowed.</p>" ]);
    }
}
