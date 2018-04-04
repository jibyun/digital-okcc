<?php

use Illuminate\Database\Seeder;

class Code_CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Member Status: 회원, 비정기출석, 장기결석, 해외거주, 이명, 사망, 전도대상자
        DB::table('code_categories')->insert([ 
            'txt' => 'Member Status',
            'kor_txt' => '교인상태',
            'memo' => 'A code category for identifying the status of OKCC members.',
            'order' => 0
        ]);
        // Duty: 교회직분 - 담임목사, 부목사, 목사, 전도사, 교육목사, 교육전도사, 시무장로, 은퇴장로, 권사, 은퇴권사, 집사, 협동장로, 협동권사, 위원
        DB::table('code_categories')->insert([ 
            'txt' => 'Duty',
            'kor_txt' => '직무',
            'memo' => 'A code category for identifying the duty of OKCC members.',
            'order' => 5
        ]);
        // Family Relations: 본인, 처, 자녀, 부모, 손주 
        DB::table('code_categories')->insert([ 
            'txt' => 'Family Relations',
            'kor_txt' => '가족관계',
            'memo' => 'A code category for identifying the relationship with the head of household.',
            'order' => 10
        ]);
        // Baptism Status: 세례, 유아세례, 입교, 영세
        DB::table('code_categories')->insert([ 
            'txt' => 'Baptism Status',
            'kor_txt' => '신급',
            'memo' => 'A code category for identifying the baptism status of OKCC members.',
            'order' => 15
        ]);
        // Department: 당회, 권사회, 집사회, 교육부, 성가대, 단기선교회, 남선교회, 제1여선교회, 제2여선교회 등
        DB::table('code_categories')->insert([ 
            'txt' => 'Department',
            'kor_txt' => '부서',
            'memo' => 'A code category for identifying the department of OKCC.',
            'order' => 20
        ]);
        // City code
        DB::table('code_categories')->insert([ 
            'txt' => 'City',
            'kor_txt' => '시',
            'memo' => 'A code category for identifying Cities of Canada.',
            'order' => 95
        ]);
        // Province code
        DB::table('code_categories')->insert([ 
            'txt' => 'Province',
            'kor_txt' => '주',
            'memo' => 'A code category for identifying Provinces of Canada.',
            'order' => 98
        ]);
        // Country code
        DB::table('code_categories')->insert([ 
            'txt' => 'Country',
            'kor_txt' => '국가',
            'memo' => 'A code category for identifying Country.',
            'order' => 99
        ]);
    }
}
