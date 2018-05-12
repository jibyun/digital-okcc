<?php

use Illuminate\Database\Seeder;

class DepartmentTreesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 집사회 -> 관리위원회
        DB::table('department_trees')->insert([ 'parent_id' => 50003, 'child_id' => 50004 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 50004, 'child_id' => 50009 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 50004, 'child_id' => 50010 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 50004, 'child_id' => 50011 ]);
        // 집사회 -> 예배위원회
        DB::table('department_trees')->insert([ 'parent_id' => 50003, 'child_id' => 50005 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 50005, 'child_id' => 50012 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 50005, 'child_id' => 50013 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 50005, 'child_id' => 50014 ]);
        // 집사회 -> 교육위원회
        DB::table('department_trees')->insert([ 'parent_id' => 50003, 'child_id' => 50006 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 50006, 'child_id' => 50015 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 50006, 'child_id' => 50016 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 50006, 'child_id' => 50017 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 50006, 'child_id' => 50018 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 50006, 'child_id' => 50019 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 50006, 'child_id' => 50020 ]);
        // 집사회 -> 선교위원회
        DB::table('department_trees')->insert([ 'parent_id' => 50003, 'child_id' => 50007 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 50007, 'child_id' => 50021 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 50007, 'child_id' => 50022 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 50007, 'child_id' => 50023 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 50007, 'child_id' => 50024 ]);
        // 집사회 -> 친교위원회
        DB::table('department_trees')->insert([ 'parent_id' => 50003, 'child_id' => 50008 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 50008, 'child_id' => 50025 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 50008, 'child_id' => 50026 ]);

        // 1 교구
        DB::table('department_trees')->insert([ 'parent_id' => 90001, 'child_id' => 90101 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90001, 'child_id' => 90102 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90001, 'child_id' => 90103 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90001, 'child_id' => 90104 ]);
        // 2 교구
        DB::table('department_trees')->insert([ 'parent_id' => 90002, 'child_id' => 90105 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90002, 'child_id' => 90106 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90002, 'child_id' => 90107 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90002, 'child_id' => 90108 ]);
        // 3 교구
        DB::table('department_trees')->insert([ 'parent_id' => 90003, 'child_id' => 90109 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90003, 'child_id' => 90110 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90003, 'child_id' => 90111 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90003, 'child_id' => 90112 ]);
        // 4 교구
        DB::table('department_trees')->insert([ 'parent_id' => 90004, 'child_id' => 90113 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90004, 'child_id' => 90114 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90004, 'child_id' => 90115 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90004, 'child_id' => 90116 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90004, 'child_id' => 90117 ]);
        // 5 교구
        DB::table('department_trees')->insert([ 'parent_id' => 90005, 'child_id' => 90118 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90005, 'child_id' => 90119 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90005, 'child_id' => 90120 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90005, 'child_id' => 90121 ]);
        // 6 교구
        DB::table('department_trees')->insert([ 'parent_id' => 90006, 'child_id' => 90122 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90006, 'child_id' => 90123 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90006, 'child_id' => 90124 ]);
        DB::table('department_trees')->insert([ 'parent_id' => 90006, 'child_id' => 90125 ]);
    }
}
