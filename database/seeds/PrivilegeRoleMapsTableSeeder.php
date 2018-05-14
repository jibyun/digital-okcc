<?php

use Illuminate\Database\Seeder;

class PrivilegeRoleMapsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SYSTEM_ADMIN
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 1, 'role_id' => 1 ]); // MEMBER_ACCESS_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 1, 'role_id' => 2 ]); // FINANCE_ACCESS_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 1, 'role_id' => 3 ]); // INVENTORY_ACCESS_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 1, 'role_id' => 4 ]); // ADMIN_ACCESS_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 1, 'role_id' => 5 ]); // ADMIN_MEMBER_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 1, 'role_id' => 6 ]); // ADMIN_USER_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 1, 'role_id' => 7 ]); // ADMIN_FINANCE_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 1, 'role_id' => 8 ]); // ADMIN_INVENTORY_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 1, 'role_id' => 9 ]); // ADMIN_TEST_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 1, 'role_id' => 10 ]); // ADMIN_HOME_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 1, 'role_id' => 11 ]); // ADMIN_SUPER_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 1, 'role_id' => 12 ]); // MEMBER_SIMBANG_ROLE
        // SENIOR_PASTOR
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 2, 'role_id' => 1 ]); // MEMBER_ACCESS_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 2, 'role_id' => 2 ]); // FINANCE_ACCESS_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 2, 'role_id' => 3 ]); // INVENTORY_ACCESS_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 2, 'role_id' => 4 ]); // ADMIN_ACCESS_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 2, 'role_id' => 5 ]); // ADMIN_MEMBER_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 2, 'role_id' => 10 ]); // ADMIN_HOME_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 2, 'role_id' => 12 ]); // MEMBER_SIMBANG_ROLE
        // ASSOCIATE_PASTOR
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 3, 'role_id' => 1 ]); // MEMBER_ACCESS_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 3, 'role_id' => 12 ]); // MEMBER_SIMBANG_ROLE
        // PASTOR
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 4, 'role_id' => 1 ]); // MEMBER_ACCESS_ROLE
        // CLERK
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 5, 'role_id' => 1 ]); // MEMBER_ACCESS_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 5, 'role_id' => 2 ]); // FINANCE_ACCESS_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 5, 'role_id' => 3 ]); // INVENTORY_ACCESS_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 5, 'role_id' => 4 ]); // ADMIN_ACCESS_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 5, 'role_id' => 5 ]); // ADMIN_MEMBER_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 5, 'role_id' => 10 ]); // ADMIN_HOME_ROLE
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 5, 'role_id' => 12 ]); // MEMBER_SIMBANG_ROLE
        // BOD
        DB::table('privilege_role_maps')->insert([ 'privilege_id' => 6, 'role_id' => 1 ]); // MEMBER_ACCESS_ROLE
    }
}
