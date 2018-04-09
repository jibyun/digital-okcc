<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder {

    public function run() {
        DB::table('roles')->insert([ 
            'txt' => 'Global', 
            'memo' => "<p>This access level gives a user access to all records in the organization, regardless of the business unit hierarchical level that the instance or the user belongs to. Users who have Global access automatically have Deep, Local, and Basic access, also.</p><p>Because this access level gives access to information throughout the organization, it should be restricted to match the organization's data security plan. This level of access is usually reserved for managers with authority over the organization.</p><p>The application refers to this access level as <strong>Organization</strong>.</p>"
        ]);
        DB::table('roles')->insert([ 
            'txt' => 'Deep', 
            'memo' => "<p>This access level gives a user access to records in the user's business unit and all business units subordinate to the user's business unit.</p><p>Users who have Deep access automatically have Local and Basic access, also. Because this access level gives access to information throughout the business unit and subordinate business units, it should be restricted to match the organization's data security plan. This level of access is usually reserved for managers with authority over the business units.</p><p>The application refers to this access level as  <strong>Parent: Child Business Units</strong>.</p>"
        ]);
        DB::table('roles')->insert([ 
            'txt' => 'Local', 
            'memo' => "<p>This access level gives a user access to records in the user's business unit. Users who have Local access automatically have Basic access, also.</p><p>Because this access level gives access to information throughout the business unit, it should be restricted to match the organization's data security plan. This level of access is usually reserved for managers with authority over the business unit.</p><p>The application refers to this access level as <strong>Business Unit</strong>.</p>"
        ]);
        DB::table('roles')->insert([ 
            'txt' => 'Basic', 
            'memo' => "<p>This access level gives a user access to records that the user owns, objects that are shared with the user, and objects that are shared with a team that the user is a member of.</p><p>This is the typical level of access for sales and service representatives.</p><p>The application refers to this access level as <strong>User</strong>.</p>"
        ]);
        DB::table('roles')->insert([ 
            'txt' => 'None', 
            'memo' => "<p>No access is allowed.</p>"
        ]);
    }
}
