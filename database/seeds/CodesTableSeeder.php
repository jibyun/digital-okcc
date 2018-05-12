<?php

use Illuminate\Database\Seeder;

class CodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Member Status
        DB::table('codes')->insert([ 'id' => 10001, 'code_category_id' => 1, 'order' => 1,  'txt' => 'Acting Member', 'kor_txt' => '등록교인' ]);
        DB::table('codes')->insert([ 'id' => 10002, 'code_category_id' => 1, 'order' => 2,  'txt' => 'Member not Attending', 'kor_txt' => '장기결석교인' ]);
        DB::table('codes')->insert([ 'id' => 10003, 'code_category_id' => 1, 'order' => 3,  'txt' => 'Living in Korea', 'kor_txt' => '한국거주교인' ]);
        DB::table('codes')->insert([ 'id' => 10004, 'code_category_id' => 1, 'order' => 4,  'txt' => 'Evangelism Target', 'kor_txt' => '전도대상가족' ]);
        DB::table('codes')->insert([ 'id' => 10005, 'code_category_id' => 1, 'order' => 5,  'txt' => 'Deceased Member', 'kor_txt' => '사망교인' ]);
        DB::table('codes')->insert([ 'id' => 10006, 'code_category_id' => 1, 'order' => 6,  'txt' => 'Member Leaving Ottawa', 'kor_txt' => '이주교인' ]);

        // Duty
        DB::table('codes')->insert([ 'id' => 20001, 'code_category_id' => 2, 'order' => 1, 'txt' => 'Senior Pastor', 'kor_txt' => '담임목사' ]);
        DB::table('codes')->insert([ 'id' => 20002, 'code_category_id' => 2, 'order' => 2, 'txt' => 'Associate Pastor', 'kor_txt' => '부목사' ]);
        DB::table('codes')->insert([ 'id' => 20003, 'code_category_id' => 2, 'order' => 3, 'txt' => 'Assistant Pastor', 'kor_txt' => '전임목사' ]);
        DB::table('codes')->insert([ 'id' => 20004, 'code_category_id' => 2, 'order' => 4, 'txt' => 'Education Pastor', 'kor_txt' => '교육목사' ]);
        DB::table('codes')->insert([ 'id' => 20005, 'code_category_id' => 2, 'order' => 5, 'txt' => 'Junior Education Pastor', 'kor_txt' => '교육전도사' ]);
        DB::table('codes')->insert([ 'id' => 20006, 'code_category_id' => 2, 'order' => 6, 'txt' => 'Active Elders', 'kor_txt' => '시무장로' ]);
        DB::table('codes')->insert([ 'id' => 20007, 'code_category_id' => 2, 'order' => 7, 'txt' => 'Retired Elders', 'kor_txt' => '은퇴장로' ]);
        DB::table('codes')->insert([ 'id' => 20008, 'code_category_id' => 2, 'order' => 8, 'txt' => 'Cooperative Elders', 'kor_txt' => '협동장로' ]);
        DB::table('codes')->insert([ 'id' => 20009, 'code_category_id' => 2, 'order' => 9, 'txt' => 'Active Kwonsa', 'kor_txt' => '시무권사' ]);
        DB::table('codes')->insert([ 'id' => 20010, 'code_category_id' => 2, 'order' => 10, 'txt' => 'Retired Kwonsa', 'kor_txt' => '은퇴권사' ]);
        DB::table('codes')->insert([ 'id' => 20011, 'code_category_id' => 2, 'order' => 11, 'txt' => 'Cooperative Kwonsa', 'kor_txt' => '협동권사' ]);
        DB::table('codes')->insert([ 'id' => 20012, 'code_category_id' => 2, 'order' => 12, 'txt' => 'Deacon', 'kor_txt' => '집사' ]);
        DB::table('codes')->insert([ 'id' => 20013, 'code_category_id' => 2, 'order' => 13, 'txt' => 'None', 'kor_txt' => '직분없음' ]);

        // Family Relations
        DB::table('codes')->insert([ 'id' => 30001, 'code_category_id' => 3, 'order' => 1,  'txt' => 'Self', 'kor_txt' => '본인' ]);
        DB::table('codes')->insert([ 'id' => 30002, 'code_category_id' => 3, 'order' => 2,  'txt' => 'Spouse', 'kor_txt' => '배우자' ]);
        DB::table('codes')->insert([ 'id' => 30003, 'code_category_id' => 3, 'order' => 3,  'txt' => 'Son', 'kor_txt' => '아들' ]);
        DB::table('codes')->insert([ 'id' => 30004, 'code_category_id' => 3, 'order' => 4,  'txt' => 'Daughter', 'kor_txt' => '딸' ]);
        DB::table('codes')->insert([ 'id' => 30005, 'code_category_id' => 3, 'order' => 5,  'txt' => 'Father', 'kor_txt' => '아버지' ]);
        DB::table('codes')->insert([ 'id' => 30006, 'code_category_id' => 3, 'order' => 6,  'txt' => 'Mother', 'kor_txt' => '어머니' ]);
        DB::table('codes')->insert([ 'id' => 30007, 'code_category_id' => 3, 'order' => 7,  'txt' => 'Grandfather', 'kor_txt' => '할아버지' ]);
        DB::table('codes')->insert([ 'id' => 30008, 'code_category_id' => 3, 'order' => 8,  'txt' => 'Grandmother', 'kor_txt' => '할머니' ]);
        DB::table('codes')->insert([ 'id' => 30009, 'code_category_id' => 3, 'order' => 9,  'txt' => 'Grandson', 'kor_txt' => '손자' ]);
        DB::table('codes')->insert([ 'id' => 30010, 'code_category_id' => 3, 'order' => 10, 'txt' => 'Granddaughter', 'kor_txt' => '손녀' ]);
        DB::table('codes')->insert([ 'id' => 30011, 'code_category_id' => 3, 'order' => 11, 'txt' => 'Relative', 'kor_txt' => '친척' ]);
        DB::table('codes')->insert([ 'id' => 30012, 'code_category_id' => 3, 'order' => 12, 'txt' => 'Etc.', 'kor_txt' => '기타' ]);

        // Baptism Status
        DB::table('codes')->insert([ 'id' => 40001, 'code_category_id' => 4, 'order' => 1,  'txt' => 'Baptism', 'kor_txt' => '세례' ]);
        DB::table('codes')->insert([ 'id' => 40002, 'code_category_id' => 4, 'order' => 2,  'txt' => 'Confirmation', 'kor_txt' => '입교' ]);
        DB::table('codes')->insert([ 'id' => 40003, 'code_category_id' => 4, 'order' => 3,  'txt' => 'Infant Baptism', 'kor_txt' => '유아세례' ]);
        DB::table('codes')->insert([ 'id' => 40004, 'code_category_id' => 4, 'order' => 4,  'txt' => 'Catholic Baptism', 'kor_txt' => '영세' ]);
        DB::table('codes')->insert([ 'id' => 40005, 'code_category_id' => 4, 'order' => 5,  'txt' => 'Unbaptized', 'kor_txt' => '무세' ]);

        // Department: 당회, 권사회, 집사회, 교육부, 성가대, 단기선교회, 남선교회, 제1여선교회, 제2여선교회 등
        DB::table('codes')->insert([ 'id' => 50001, 'code_category_id' => 5, 'order' => 1,  'txt' => 'Session', 'kor_txt' => '당회' ]);
        DB::table('codes')->insert([ 'id' => 50002, 'code_category_id' => 5, 'order' => 2,  'txt' => 'Board Of Kwonsas', 'kor_txt' => '권사회' ]);
        DB::table('codes')->insert([ 'id' => 50003, 'code_category_id' => 5, 'order' => 3,  'txt' => 'Board Of Decons', 'kor_txt' => '집사회' ]);
        //-- 집사회 최상위 조직 (목사님 영어안과 2018 예산서 영어표기가 틀려 목사님 안으로 채택)
        DB::table('codes')->insert([ 'id' => 50004, 'code_category_id' => 5, 'order' => 4,  'txt' => 'Administration Committee', 'kor_txt' => '관리위원회' ]);
        DB::table('codes')->insert([ 'id' => 50005, 'code_category_id' => 5, 'order' => 5,  'txt' => 'Worship Committee', 'kor_txt' => '예배위원회' ]);
        DB::table('codes')->insert([ 'id' => 50006, 'code_category_id' => 5, 'order' => 6,  'txt' => 'Christian Education Committee', 'kor_txt' => '교육위원회' ]);
        DB::table('codes')->insert([ 'id' => 50007, 'code_category_id' => 5, 'order' => 7,  'txt' => 'Mission Committee', 'kor_txt' => '선교위원회' ]);
        DB::table('codes')->insert([ 'id' => 50008, 'code_category_id' => 5, 'order' => 8,  'txt' => 'Fellowship Committee', 'kor_txt' => '친교위원회' ]);
        //----- 집사회 관리위원회 부서 (Ref. 2018 예산서)
        DB::table('codes')->insert([ 'id' => 50009, 'code_category_id' => 5, 'order' => 9,  'txt' => 'Administration and Publication', 'kor_txt' => '서무출판부' ]);
        DB::table('codes')->insert([ 'id' => 50010, 'code_category_id' => 5, 'order' => 10, 'txt' => 'Finance', 'kor_txt' => '재정부' ]);
        DB::table('codes')->insert([ 'id' => 50011, 'code_category_id' => 5, 'order' => 11, 'txt' => 'Facility Management', 'kor_txt' => '시설부' ]);
        //----- 집사회 예배위원회 부서 (Ref. 2018 예산서)
        DB::table('codes')->insert([ 'id' => 50012, 'code_category_id' => 5, 'order' => 12, 'txt' => 'Worship', 'kor_txt' => '예배부' ]);
        DB::table('codes')->insert([ 'id' => 50013, 'code_category_id' => 5, 'order' => 13, 'txt' => 'Media', 'kor_txt' => '미디어부' ]);
        DB::table('codes')->insert([ 'id' => 50014, 'code_category_id' => 5, 'order' => 14, 'txt' => 'Mahanaim Choir', 'kor_txt' => '마하나임성가대' ]);
        //----- 집사회 교육위원회 부서 (Ref. 2018 예산서)
        DB::table('codes')->insert([ 'id' => 50015, 'code_category_id' => 5, 'order' => 15, 'txt' => 'Ainos', 'kor_txt' => '유치부:아이노스' ]);
        DB::table('codes')->insert([ 'id' => 50016, 'code_category_id' => 5, 'order' => 16, 'txt' => 'Philoi', 'kor_txt' => '유초등부:필로이' ]);
        DB::table('codes')->insert([ 'id' => 50017, 'code_category_id' => 5, 'order' => 17, 'txt' => 'Youth', 'kor_txt' => '청소년부:유스' ]);
        DB::table('codes')->insert([ 'id' => 50018, 'code_category_id' => 5, 'order' => 18, 'txt' => 'Bahurim', 'kor_txt' => '청년부:바후림' ]);
        DB::table('codes')->insert([ 'id' => 50019, 'code_category_id' => 5, 'order' => 19, 'txt' => 'MOSAIC', 'kor_txt' => '성인영어부' ]);
        DB::table('codes')->insert([ 'id' => 50020, 'code_category_id' => 5, 'order' => 20, 'txt' => 'Adult School', 'kor_txt' => '성인교육부' ]);
        //----- 집사회 선교위원회 부서 (Ref. 2018 예산서)
        DB::table('codes')->insert([ 'id' => 50021, 'code_category_id' => 5, 'order' => 21, 'txt' => 'Local Missionary', 'kor_txt' => '전도부' ]);
        DB::table('codes')->insert([ 'id' => 50022, 'code_category_id' => 5, 'order' => 22, 'txt' => 'Charity', 'kor_txt' => '구제부' ]);
        DB::table('codes')->insert([ 'id' => 50023, 'code_category_id' => 5, 'order' => 23, 'txt' => 'Multi-ethnic Missionary', 'kor_txt' => '다민족선교부' ]);
        DB::table('codes')->insert([ 'id' => 50024, 'code_category_id' => 5, 'order' => 24, 'txt' => 'Overseas Missionary', 'kor_txt' => '해외선교부' ]);
        //----- 집사회 친교위원회 부서 (Ref. 2018 예산서)
        DB::table('codes')->insert([ 'id' => 50025, 'code_category_id' => 5, 'order' => 25, 'txt' => 'Fellowship', 'kor_txt' => '친교부' ]);
        DB::table('codes')->insert([ 'id' => 50026, 'code_category_id' => 5, 'order' => 26, 'txt' => 'New Members', 'kor_txt' => '새교우부' ]);
        // 선교회(분류): 남선교회, 젊은부부선교회, 제1여선교회, 제2여선교회
        DB::table('codes')->insert([ 'id' => 50027, 'code_category_id' => 5, 'order' => 27, 'txt' => 'Mission Group', 'kor_txt' => '선교회' ]);
        DB::table('codes')->insert([ 'id' => 50028, 'code_category_id' => 5, 'order' => 28, 'txt' => "Men's Mission Group", 'kor_txt' => '남선교회' ]);
        DB::table('codes')->insert([ 'id' => 50029, 'code_category_id' => 5, 'order' => 29, 'txt' => "Young Family Group", 'kor_txt' => '젊은부부선교회' ]);
        DB::table('codes')->insert([ 'id' => 50030, 'code_category_id' => 5, 'order' => 30, 'txt' => "First Women's Mission Group", 'kor_txt' => '제1여선교회' ]);
        DB::table('codes')->insert([ 'id' => 50031, 'code_category_id' => 5, 'order' => 31, 'txt' => "Second Women's Mission Group", 'kor_txt' => '제2여선교회' ]);
        // 특별위원회: Parent 코드를 갖지 않고 자유롭게 확장하여 쓸 수 있도록 구성
        DB::table('codes')->insert([ 'id' => 50032, 'code_category_id' => 5, 'order' => 32, 'txt' => 'Church Building Committee', 'kor_txt' => '이전위원회' ]);
        DB::table('codes')->insert([ 'id' => 50033, 'code_category_id' => 5, 'order' => 33, 'txt' => 'Associate Pastor Searching Committee', 'kor_txt' => '부목사청빙위원회' ]);
        DB::table('codes')->insert([ 'id' => 50034, 'code_category_id' => 5, 'order' => 34, 'txt' => 'Church Constitute Committee', 'kor_txt' => '헌장위원회' ]);
        DB::table('codes')->insert([ 'id' => 50035, 'code_category_id' => 5, 'order' => 35, 'txt' => 'Task Force for Refugee', 'kor_txt' => '난민 TF' ]);

        // City 
        DB::table('codes')->insert([ 'id' => 60001, 'code_category_id' => 6, 'order' => 1,   'txt' => 'Airdrie', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60002, 'code_category_id' => 6, 'order' => 2,   'txt' => 'Brooks', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60003, 'code_category_id' => 6, 'order' => 3,   'txt' => 'Calgary', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60004, 'code_category_id' => 6, 'order' => 4,   'txt' => 'Camrose', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60005, 'code_category_id' => 6, 'order' => 5,   'txt' => 'Chestermere', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60006, 'code_category_id' => 6, 'order' => 6,   'txt' => 'Cold Lake', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60007, 'code_category_id' => 6, 'order' => 7,   'txt' => 'Edmonton', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60008, 'code_category_id' => 6, 'order' => 8,   'txt' => 'Fort Saskatchewan', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60009, 'code_category_id' => 6, 'order' => 9,   'txt' => 'Grande Prairie', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60010, 'code_category_id' => 6, 'order' => 10,  'txt' => 'Lacombe', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60011, 'code_category_id' => 6, 'order' => 11,  'txt' => 'Leduc', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60012, 'code_category_id' => 6, 'order' => 12,  'txt' => 'Lethbridge', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60013, 'code_category_id' => 6, 'order' => 13,  'txt' => 'Lloydminster', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60014, 'code_category_id' => 6, 'order' => 14,  'txt' => 'Medicine Hat', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60015, 'code_category_id' => 6, 'order' => 15,  'txt' => 'Red Deer', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60016, 'code_category_id' => 6, 'order' => 16,  'txt' => 'Spruce Grove', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60017, 'code_category_id' => 6, 'order' => 17,  'txt' => 'St. Albert', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60018, 'code_category_id' => 6, 'order' => 18,  'txt' => 'Wetaskiwin', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60019, 'code_category_id' => 6, 'order' => 19,  'txt' => 'Abbotsford', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60020, 'code_category_id' => 6, 'order' => 20,  'txt' => 'Armstrong', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60021, 'code_category_id' => 6, 'order' => 21,  'txt' => 'Burnaby', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60022, 'code_category_id' => 6, 'order' => 22,  'txt' => 'Campbell River', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60023, 'code_category_id' => 6, 'order' => 23,  'txt' => 'Castlegar', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60024, 'code_category_id' => 6, 'order' => 24,  'txt' => 'Chilliwack', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60025, 'code_category_id' => 6, 'order' => 25,  'txt' => 'Colwood', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60026, 'code_category_id' => 6, 'order' => 26,  'txt' => 'Coquitlam', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60027, 'code_category_id' => 6, 'order' => 27,  'txt' => 'Courtenay', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60028, 'code_category_id' => 6, 'order' => 28,  'txt' => 'Cranbrook', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60029, 'code_category_id' => 6, 'order' => 29,  'txt' => 'Dawson Creek', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60030, 'code_category_id' => 6, 'order' => 30,  'txt' => 'Delta', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60031, 'code_category_id' => 6, 'order' => 31,  'txt' => 'Duncan', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60032, 'code_category_id' => 6, 'order' => 32,  'txt' => 'Enderby', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60033, 'code_category_id' => 6, 'order' => 33,  'txt' => 'Fernie', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60034, 'code_category_id' => 6, 'order' => 34,  'txt' => 'Fort St. John', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60035, 'code_category_id' => 6, 'order' => 35,  'txt' => 'Grand Forks', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60036, 'code_category_id' => 6, 'order' => 36,  'txt' => 'Greenwood', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60037, 'code_category_id' => 6, 'order' => 37,  'txt' => 'Kamloops', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60038, 'code_category_id' => 6, 'order' => 38,  'txt' => 'Kelowna', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60039, 'code_category_id' => 6, 'order' => 39,  'txt' => 'Kimberley', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60040, 'code_category_id' => 6, 'order' => 40,  'txt' => 'Langford', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60041, 'code_category_id' => 6, 'order' => 41,  'txt' => 'Langley', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60042, 'code_category_id' => 6, 'order' => 42,  'txt' => 'Maple Ridge', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60043, 'code_category_id' => 6, 'order' => 43,  'txt' => 'Merritt', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60044, 'code_category_id' => 6, 'order' => 44,  'txt' => 'Nanaimo', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60045, 'code_category_id' => 6, 'order' => 45,  'txt' => 'Nelson', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60046, 'code_category_id' => 6, 'order' => 46,  'txt' => 'New Westminster', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60047, 'code_category_id' => 6, 'order' => 47,  'txt' => 'North Vancouver', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60048, 'code_category_id' => 6, 'order' => 48,  'txt' => 'Parksville', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60049, 'code_category_id' => 6, 'order' => 49,  'txt' => 'Penticton', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60050, 'code_category_id' => 6, 'order' => 50,  'txt' => 'Pitt Meadows', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60051, 'code_category_id' => 6, 'order' => 51,  'txt' => 'Port Alberni', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60052, 'code_category_id' => 6, 'order' => 52,  'txt' => 'Port Coquitlam', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60053, 'code_category_id' => 6, 'order' => 53,  'txt' => 'Port Moody', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60054, 'code_category_id' => 6, 'order' => 54,  'txt' => 'Powell River', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60055, 'code_category_id' => 6, 'order' => 55,  'txt' => 'Prince George', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60056, 'code_category_id' => 6, 'order' => 56,  'txt' => 'Prince Rupert', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60057, 'code_category_id' => 6, 'order' => 57,  'txt' => 'Quesnel', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60058, 'code_category_id' => 6, 'order' => 58,  'txt' => 'Revelstoke', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60059, 'code_category_id' => 6, 'order' => 59,  'txt' => 'Richmond', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60060, 'code_category_id' => 6, 'order' => 60,  'txt' => 'Rossland', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60061, 'code_category_id' => 6, 'order' => 61,  'txt' => 'Salmon Arm', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60062, 'code_category_id' => 6, 'order' => 62,  'txt' => 'Surrey', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60063, 'code_category_id' => 6, 'order' => 63,  'txt' => 'Terrace', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60064, 'code_category_id' => 6, 'order' => 64,  'txt' => 'Trail', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60065, 'code_category_id' => 6, 'order' => 65,  'txt' => 'Vancouver', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60066, 'code_category_id' => 6, 'order' => 66,  'txt' => 'Vernon', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60067, 'code_category_id' => 6, 'order' => 67,  'txt' => 'Victoria', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60068, 'code_category_id' => 6, 'order' => 68,  'txt' => 'West Kelowna', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60069, 'code_category_id' => 6, 'order' => 69,  'txt' => 'White Rock', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60070, 'code_category_id' => 6, 'order' => 70,  'txt' => 'Williams Lake', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60071, 'code_category_id' => 6, 'order' => 71,  'txt' => 'Brandon', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60072, 'code_category_id' => 6, 'order' => 72,  'txt' => 'Dauphin', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60073, 'code_category_id' => 6, 'order' => 73,  'txt' => 'Flin Flon', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60074, 'code_category_id' => 6, 'order' => 74,  'txt' => 'Morden', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60075, 'code_category_id' => 6, 'order' => 75,  'txt' => 'Portage la Prairie', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60076, 'code_category_id' => 6, 'order' => 76,  'txt' => 'Selkirk', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60077, 'code_category_id' => 6, 'order' => 77,  'txt' => 'Steinbach', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60078, 'code_category_id' => 6, 'order' => 78,  'txt' => 'Thompson', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60079, 'code_category_id' => 6, 'order' => 79,  'txt' => 'Winkler', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60080, 'code_category_id' => 6, 'order' => 80,  'txt' => 'Winnipeg', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60081, 'code_category_id' => 6, 'order' => 81,  'txt' => 'Bathurst', 'kor_txt' => 'NB' ]);
        DB::table('codes')->insert([ 'id' => 60082, 'code_category_id' => 6, 'order' => 82,  'txt' => 'Campbellton', 'kor_txt' => 'NB' ]);
        DB::table('codes')->insert([ 'id' => 60083, 'code_category_id' => 6, 'order' => 83,  'txt' => 'Dieppe', 'kor_txt' => 'NB' ]);
        DB::table('codes')->insert([ 'id' => 60084, 'code_category_id' => 6, 'order' => 84,  'txt' => 'Edmundston', 'kor_txt' => 'NB' ]);
        DB::table('codes')->insert([ 'id' => 60085, 'code_category_id' => 6, 'order' => 85,  'txt' => 'Fredericton', 'kor_txt' => 'NB' ]);
        DB::table('codes')->insert([ 'id' => 60086, 'code_category_id' => 6, 'order' => 86,  'txt' => 'Miramichi', 'kor_txt' => 'NB' ]);
        DB::table('codes')->insert([ 'id' => 60087, 'code_category_id' => 6, 'order' => 87,  'txt' => 'Moncton', 'kor_txt' => 'NB' ]);
        DB::table('codes')->insert([ 'id' => 60088, 'code_category_id' => 6, 'order' => 88,  'txt' => 'Saint John', 'kor_txt' => 'NB' ]);
        DB::table('codes')->insert([ 'id' => 60089, 'code_category_id' => 6, 'order' => 89,  'txt' => 'Corner Brook', 'kor_txt' => 'NL' ]);
        DB::table('codes')->insert([ 'id' => 60090, 'code_category_id' => 6, 'order' => 90,  'txt' => 'Mount Pearl', 'kor_txt' => 'NL' ]);
        DB::table('codes')->insert([ 'id' => 60091, 'code_category_id' => 6, 'order' => 91,  'txt' => "St. John's", 'kor_txt' => 'NL' ]);
        DB::table('codes')->insert([ 'id' => 60092, 'code_category_id' => 6, 'order' => 92,  'txt' => 'Dartmouth', 'kor_txt' => 'NS' ]);
        DB::table('codes')->insert([ 'id' => 60093, 'code_category_id' => 6, 'order' => 93,  'txt' => 'Halifax', 'kor_txt' => 'NS' ]);
        DB::table('codes')->insert([ 'id' => 60094, 'code_category_id' => 6, 'order' => 94,  'txt' => 'Sydney', 'kor_txt' => 'NS' ]);
        DB::table('codes')->insert([ 'id' => 60095, 'code_category_id' => 6, 'order' => 95,  'txt' => 'Yellowknife', 'kor_txt' => 'NT' ]);
        DB::table('codes')->insert([ 'id' => 60096, 'code_category_id' => 6, 'order' => 96,  'txt' => 'Iqaluit', 'kor_txt' => 'NU' ]);
        DB::table('codes')->insert([ 'id' => 60097, 'code_category_id' => 6, 'order' => 97,  'txt' => 'Algonquin Provincial Park', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60098, 'code_category_id' => 6, 'order' => 98,  'txt' => 'Almonte', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60099, 'code_category_id' => 6, 'order' => 99,  'txt' => 'Arnprior', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60100, 'code_category_id' => 6, 'order' => 100, 'txt' => 'Barrhaven', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60101, 'code_category_id' => 6, 'order' => 101, 'txt' => 'Barrie', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60102, 'code_category_id' => 6, 'order' => 102, 'txt' => "Barry's Bay", 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60103, 'code_category_id' => 6, 'order' => 103, 'txt' => 'Belleville', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60104, 'code_category_id' => 6, 'order' => 104, 'txt' => 'Brampton', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60105, 'code_category_id' => 6, 'order' => 105, 'txt' => 'Brant', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60106, 'code_category_id' => 6, 'order' => 106, 'txt' => 'Brantford', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60107, 'code_category_id' => 6, 'order' => 107, 'txt' => 'Brockville', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60108, 'code_category_id' => 6, 'order' => 108, 'txt' => 'Burlington', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60109, 'code_category_id' => 6, 'order' => 109, 'txt' => 'Cambridge', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60110, 'code_category_id' => 6, 'order' => 110, 'txt' => 'Carp', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60111, 'code_category_id' => 6, 'order' => 111, 'txt' => 'Carp', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60112, 'code_category_id' => 6, 'order' => 112, 'txt' => 'Chalk River', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60113, 'code_category_id' => 6, 'order' => 113, 'txt' => 'Clarence-Rockland', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60114, 'code_category_id' => 6, 'order' => 114, 'txt' => 'Cobden', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60115, 'code_category_id' => 6, 'order' => 115, 'txt' => 'Cornwall', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60116, 'code_category_id' => 6, 'order' => 116, 'txt' => 'Deep River', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60117, 'code_category_id' => 6, 'order' => 117, 'txt' => 'Dryden', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60118, 'code_category_id' => 6, 'order' => 118, 'txt' => 'Dunrobin', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60119, 'code_category_id' => 6, 'order' => 119, 'txt' => 'Elliot Lake', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60120, 'code_category_id' => 6, 'order' => 120, 'txt' => 'Fitzroy Harbour', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60121, 'code_category_id' => 6, 'order' => 121, 'txt' => 'Greater Sudbury', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60122, 'code_category_id' => 6, 'order' => 122, 'txt' => 'Guelph', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60123, 'code_category_id' => 6, 'order' => 123, 'txt' => 'Haldimand County', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60124, 'code_category_id' => 6, 'order' => 124, 'txt' => 'Hamilton', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60125, 'code_category_id' => 6, 'order' => 125, 'txt' => 'Kanata', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60126, 'code_category_id' => 6, 'order' => 126, 'txt' => 'Kawartha Lakes', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60127, 'code_category_id' => 6, 'order' => 127, 'txt' => 'Kemptville', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60128, 'code_category_id' => 6, 'order' => 128, 'txt' => 'Kemptville', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60129, 'code_category_id' => 6, 'order' => 129, 'txt' => 'Kenora', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60130, 'code_category_id' => 6, 'order' => 130, 'txt' => 'Kingston', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60131, 'code_category_id' => 6, 'order' => 131, 'txt' => 'Kitchener', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60132, 'code_category_id' => 6, 'order' => 132, 'txt' => 'London', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60133, 'code_category_id' => 6, 'order' => 133, 'txt' => 'Manotick', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60134, 'code_category_id' => 6, 'order' => 134, 'txt' => 'Markham', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60135, 'code_category_id' => 6, 'order' => 135, 'txt' => 'Mattawa', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60136, 'code_category_id' => 6, 'order' => 136, 'txt' => 'Merrickville', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60137, 'code_category_id' => 6, 'order' => 137, 'txt' => 'Mississauga', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60138, 'code_category_id' => 6, 'order' => 138, 'txt' => 'Nepean', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60139, 'code_category_id' => 6, 'order' => 139, 'txt' => 'Niagara Falls', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60140, 'code_category_id' => 6, 'order' => 140, 'txt' => 'Norfolk County', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60141, 'code_category_id' => 6, 'order' => 141, 'txt' => 'North Bay', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60142, 'code_category_id' => 6, 'order' => 142, 'txt' => 'Orillia', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60143, 'code_category_id' => 6, 'order' => 143, 'txt' => 'Orleans', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60144, 'code_category_id' => 6, 'order' => 144, 'txt' => 'Oshawa', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60145, 'code_category_id' => 6, 'order' => 145, 'txt' => 'Ottawa', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60146, 'code_category_id' => 6, 'order' => 146, 'txt' => 'Owen Sound', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60147, 'code_category_id' => 6, 'order' => 147, 'txt' => 'Pembroke', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60148, 'code_category_id' => 6, 'order' => 148, 'txt' => 'Pembroke', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60149, 'code_category_id' => 6, 'order' => 149, 'txt' => 'Perth', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60150, 'code_category_id' => 6, 'order' => 150, 'txt' => 'Petawawa', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60151, 'code_category_id' => 6, 'order' => 151, 'txt' => 'Peterborough', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60152, 'code_category_id' => 6, 'order' => 152, 'txt' => 'Pickering', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60153, 'code_category_id' => 6, 'order' => 153, 'txt' => 'Port Colborne', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60154, 'code_category_id' => 6, 'order' => 154, 'txt' => 'Prince Edward County', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60155, 'code_category_id' => 6, 'order' => 155, 'txt' => 'Quinte West', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60156, 'code_category_id' => 6, 'order' => 156, 'txt' => 'Renfrew', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60157, 'code_category_id' => 6, 'order' => 157, 'txt' => 'Sarnia', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60158, 'code_category_id' => 6, 'order' => 158, 'txt' => 'Sault Ste. Marie', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60159, 'code_category_id' => 6, 'order' => 159, 'txt' => 'Smiths Falls', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60160, 'code_category_id' => 6, 'order' => 160, 'txt' => 'St. Catharines', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60161, 'code_category_id' => 6, 'order' => 161, 'txt' => 'St. Thomas', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60162, 'code_category_id' => 6, 'order' => 162, 'txt' => 'Stittsville', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60163, 'code_category_id' => 6, 'order' => 163, 'txt' => 'Stratford', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60164, 'code_category_id' => 6, 'order' => 164, 'txt' => 'Temiskaming Shores', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60165, 'code_category_id' => 6, 'order' => 165, 'txt' => 'Thorold', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60166, 'code_category_id' => 6, 'order' => 166, 'txt' => 'Thunder Bay', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60167, 'code_category_id' => 6, 'order' => 167, 'txt' => 'Timmins', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60168, 'code_category_id' => 6, 'order' => 168, 'txt' => 'Toronto', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60169, 'code_category_id' => 6, 'order' => 169, 'txt' => 'Vaughan', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60170, 'code_category_id' => 6, 'order' => 170, 'txt' => 'Waterloo', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60171, 'code_category_id' => 6, 'order' => 171, 'txt' => 'Welland', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60172, 'code_category_id' => 6, 'order' => 172, 'txt' => 'Westboro', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60173, 'code_category_id' => 6, 'order' => 173, 'txt' => 'Windsor', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60174, 'code_category_id' => 6, 'order' => 174, 'txt' => 'Woodstock', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60175, 'code_category_id' => 6, 'order' => 175, 'txt' => 'Charlottetown', 'kor_txt' => 'PE' ]);
        DB::table('codes')->insert([ 'id' => 60176, 'code_category_id' => 6, 'order' => 176, 'txt' => 'Summerside', 'kor_txt' => 'PE' ]);
        DB::table('codes')->insert([ 'id' => 60177, 'code_category_id' => 6, 'order' => 177, 'txt' => 'Buckingham', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60178, 'code_category_id' => 6, 'order' => 178, 'txt' => 'Cantley', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60179, 'code_category_id' => 6, 'order' => 179, 'txt' => 'Carillon', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60180, 'code_category_id' => 6, 'order' => 180, 'txt' => 'Chicoutimi', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60181, 'code_category_id' => 6, 'order' => 181, 'txt' => 'Fort Coulonge', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60182, 'code_category_id' => 6, 'order' => 182, 'txt' => 'Gatineau', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60183, 'code_category_id' => 6, 'order' => 183, 'txt' => 'Hull', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60184, 'code_category_id' => 6, 'order' => 184, 'txt' => 'Maniwaki', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60185, 'code_category_id' => 6, 'order' => 185, 'txt' => 'Montreal', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60186, 'code_category_id' => 6, 'order' => 186, 'txt' => 'Papineauville', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60187, 'code_category_id' => 6, 'order' => 187, 'txt' => 'Quebec City', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60188, 'code_category_id' => 6, 'order' => 188, 'txt' => 'Wakefield', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60189, 'code_category_id' => 6, 'order' => 189, 'txt' => 'Estevan', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60190, 'code_category_id' => 6, 'order' => 190, 'txt' => 'Humboldt', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60191, 'code_category_id' => 6, 'order' => 191, 'txt' => 'Martensville', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60192, 'code_category_id' => 6, 'order' => 192, 'txt' => 'Meadow Lake', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60193, 'code_category_id' => 6, 'order' => 193, 'txt' => 'Melfort', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60194, 'code_category_id' => 6, 'order' => 194, 'txt' => 'Melville', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60195, 'code_category_id' => 6, 'order' => 195, 'txt' => 'North Battleford', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60196, 'code_category_id' => 6, 'order' => 196, 'txt' => 'Prince Albert', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60197, 'code_category_id' => 6, 'order' => 197, 'txt' => 'Regina', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60198, 'code_category_id' => 6, 'order' => 198, 'txt' => 'Saskatoon', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60199, 'code_category_id' => 6, 'order' => 199, 'txt' => 'Swift Current', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60200, 'code_category_id' => 6, 'order' => 200, 'txt' => 'Warman', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60201, 'code_category_id' => 6, 'order' => 201, 'txt' => 'Weyburn', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60202, 'code_category_id' => 6, 'order' => 202, 'txt' => 'Yorkton', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60203, 'code_category_id' => 6, 'order' => 203, 'txt' => 'Whitehorse', 'kor_txt' => 'YT' ]);
        DB::table('codes')->insert([ 'id' => 60204, 'code_category_id' => 6, 'order' => 204, 'txt' => 'Carleton Place', 'kor_txt' => 'ON' ]);

        // Province
        DB::table('codes')->insert([ 'id' => 70001, 'code_category_id' => 7, 'order' => 70001, 'txt' => 'AB', 'kor_txt' => 'Alberta' ]);
        DB::table('codes')->insert([ 'id' => 70002, 'code_category_id' => 7, 'order' => 70002, 'txt' => 'BC', 'kor_txt' => 'British Columbia' ]);
        DB::table('codes')->insert([ 'id' => 70003, 'code_category_id' => 7, 'order' => 70003, 'txt' => 'MB', 'kor_txt' => 'Manitoba' ]);
        DB::table('codes')->insert([ 'id' => 70004, 'code_category_id' => 7, 'order' => 70004, 'txt' => 'NB', 'kor_txt' => 'New Brunswick' ]);
        DB::table('codes')->insert([ 'id' => 70005, 'code_category_id' => 7, 'order' => 70005, 'txt' => 'NL', 'kor_txt' => 'Newfoundland and Labrador' ]);
        DB::table('codes')->insert([ 'id' => 70006, 'code_category_id' => 7, 'order' => 70006, 'txt' => 'NT', 'kor_txt' => 'Northwest Territories' ]);
        DB::table('codes')->insert([ 'id' => 70007, 'code_category_id' => 7, 'order' => 70007, 'txt' => 'NS', 'kor_txt' => 'Nova Scotia' ]);
        DB::table('codes')->insert([ 'id' => 70008, 'code_category_id' => 7, 'order' => 70008, 'txt' => 'NU', 'kor_txt' => 'Nunavut' ]);
        DB::table('codes')->insert([ 'id' => 70009, 'code_category_id' => 7, 'order' => 70009, 'txt' => 'ON', 'kor_txt' => 'Ontario' ]);
        DB::table('codes')->insert([ 'id' => 70010, 'code_category_id' => 7, 'order' => 70010, 'txt' => 'PE', 'kor_txt' => 'Prince Edward Island' ]);
        DB::table('codes')->insert([ 'id' => 70011, 'code_category_id' => 7, 'order' => 70011, 'txt' => 'QC', 'kor_txt' => 'Quebec' ]);
        DB::table('codes')->insert([ 'id' => 70012, 'code_category_id' => 7, 'order' => 70012, 'txt' => 'SK', 'kor_txt' => 'Saskatchewan' ]);
        DB::table('codes')->insert([ 'id' => 70013, 'code_category_id' => 7, 'order' => 70013, 'txt' => 'YT', 'kor_txt' => 'Yukon' ]);

        // Country
        DB::table('codes')->insert([ 'id' => 80001, 'code_category_id' => 8, 'order' => 80001, 'txt' => 'Canada', 'kor_txt' => '캐나다' ]);
        DB::table('codes')->insert([ 'id' => 80002, 'code_category_id' => 8, 'order' => 80002, 'txt' => 'Korea', 'kor_txt' => '대한민국' ]);

        // 교구
        DB::table('codes')->insert([ 'id' => 90001, 'code_category_id' => 9, 'order' => 1, 'txt' => '1 Gyogoo', 'kor_txt' => '1교구' ]);
        DB::table('codes')->insert([ 'id' => 90002, 'code_category_id' => 9, 'order' => 2, 'txt' => '2 Gyogoo', 'kor_txt' => '2교구' ]);
        DB::table('codes')->insert([ 'id' => 90003, 'code_category_id' => 9, 'order' => 3, 'txt' => '3 Gyogoo', 'kor_txt' => '3교구' ]);
        DB::table('codes')->insert([ 'id' => 90004, 'code_category_id' => 9, 'order' => 4, 'txt' => '4 Gyogoo', 'kor_txt' => '4교구' ]);
        DB::table('codes')->insert([ 'id' => 90005, 'code_category_id' => 9, 'order' => 5, 'txt' => '5 Gyogoo', 'kor_txt' => '5교구' ]);
        DB::table('codes')->insert([ 'id' => 90006, 'code_category_id' => 9, 'order' => 6, 'txt' => '6 Gyogoo', 'kor_txt' => '6교구' ]);
        // 구역
        DB::table('codes')->insert([ 'id' => 90101, 'code_category_id' => 9, 'order' => 7,  'txt' => '1 Gooyeok', 'kor_txt' => '1구역' ]);
        DB::table('codes')->insert([ 'id' => 90102, 'code_category_id' => 9, 'order' => 8,  'txt' => '2 Gooyeok', 'kor_txt' => '2구역' ]);
        DB::table('codes')->insert([ 'id' => 90103, 'code_category_id' => 9, 'order' => 9,  'txt' => '3 Gooyeok', 'kor_txt' => '3구역' ]);
        DB::table('codes')->insert([ 'id' => 90104, 'code_category_id' => 9, 'order' => 10,  'txt' => '4 Gooyeok', 'kor_txt' => '4구역' ]);
        DB::table('codes')->insert([ 'id' => 90105, 'code_category_id' => 9, 'order' => 11,  'txt' => '5 Gooyeok', 'kor_txt' => '5구역' ]);
        DB::table('codes')->insert([ 'id' => 90106, 'code_category_id' => 9, 'order' => 12,  'txt' => '6 Gooyeok', 'kor_txt' => '6구역' ]);
        DB::table('codes')->insert([ 'id' => 90107, 'code_category_id' => 9, 'order' => 13,  'txt' => '7 Gooyeok', 'kor_txt' => '7구역' ]);
        DB::table('codes')->insert([ 'id' => 90108, 'code_category_id' => 9, 'order' => 14,  'txt' => '8 Gooyeok', 'kor_txt' => '8구역' ]);
        DB::table('codes')->insert([ 'id' => 90109, 'code_category_id' => 9, 'order' => 15,  'txt' => '9 Gooyeok', 'kor_txt' => '9구역' ]);
        DB::table('codes')->insert([ 'id' => 90110, 'code_category_id' => 9, 'order' => 16, 'txt' => '10 Gooyeok', 'kor_txt' => '10구역' ]);
        DB::table('codes')->insert([ 'id' => 90111, 'code_category_id' => 9, 'order' => 17, 'txt' => '11 Gooyeok', 'kor_txt' => '11구역' ]);
        DB::table('codes')->insert([ 'id' => 90112, 'code_category_id' => 9, 'order' => 18, 'txt' => '12 Gooyeok', 'kor_txt' => '12구역' ]);
        DB::table('codes')->insert([ 'id' => 90113, 'code_category_id' => 9, 'order' => 19, 'txt' => '13 Gooyeok', 'kor_txt' => '13구역' ]);
        DB::table('codes')->insert([ 'id' => 90114, 'code_category_id' => 9, 'order' => 20, 'txt' => '14 Gooyeok', 'kor_txt' => '14구역' ]);
        DB::table('codes')->insert([ 'id' => 90115, 'code_category_id' => 9, 'order' => 21, 'txt' => '15 Gooyeok', 'kor_txt' => '15구역' ]);
        DB::table('codes')->insert([ 'id' => 90116, 'code_category_id' => 9, 'order' => 22, 'txt' => '16 Gooyeok', 'kor_txt' => '16구역' ]);
        DB::table('codes')->insert([ 'id' => 90117, 'code_category_id' => 9, 'order' => 23, 'txt' => '17 Gooyeok', 'kor_txt' => '17구역' ]);
        DB::table('codes')->insert([ 'id' => 90118, 'code_category_id' => 9, 'order' => 24, 'txt' => '18 Gooyeok', 'kor_txt' => '18구역' ]);
        DB::table('codes')->insert([ 'id' => 90119, 'code_category_id' => 9, 'order' => 25, 'txt' => '19 Gooyeok', 'kor_txt' => '19구역' ]);
        DB::table('codes')->insert([ 'id' => 90120, 'code_category_id' => 9, 'order' => 26, 'txt' => '20 Gooyeok', 'kor_txt' => '20구역' ]);
        DB::table('codes')->insert([ 'id' => 90121, 'code_category_id' => 9, 'order' => 27, 'txt' => '21 Gooyeok', 'kor_txt' => '21구역' ]);
        DB::table('codes')->insert([ 'id' => 90122, 'code_category_id' => 9, 'order' => 28, 'txt' => '22 Gooyeok', 'kor_txt' => '22구역' ]);
        DB::table('codes')->insert([ 'id' => 90123, 'code_category_id' => 9, 'order' => 29, 'txt' => '23 Gooyeok', 'kor_txt' => '23구역' ]);
        DB::table('codes')->insert([ 'id' => 90124, 'code_category_id' => 9, 'order' => 30, 'txt' => '24 Gooyeok', 'kor_txt' => '24구역' ]);
        DB::table('codes')->insert([ 'id' => 90125, 'code_category_id' => 9, 'order' => 31, 'txt' => '25 Gooyeok', 'kor_txt' => '25구역' ]);

        // LOG
        DB::table('codes')->insert([ 'id' => 100001, 'code_category_id' => 10, 'order' => 1, 'txt' => 'LOGIN', 'kor_txt' => '로그인' ]);
        DB::table('codes')->insert([ 'id' => 100002, 'code_category_id' => 10, 'order' => 2, 'txt' => 'LOGOUT', 'kor_txt' => '로그아웃' ]);
        DB::table('codes')->insert([ 'id' => 100003, 'code_category_id' => 10, 'order' => 3, 'txt' => 'INSERT', 'kor_txt' => '추가' ]);
        DB::table('codes')->insert([ 'id' => 100004, 'code_category_id' => 10, 'order' => 4, 'txt' => 'UPDATE', 'kor_txt' => '수정' ]);
        DB::table('codes')->insert([ 'id' => 100005, 'code_category_id' => 10, 'order' => 5, 'txt' => 'DELETE', 'kor_txt' => '삭제' ]);

        // POSITION
        //--- 부서의 직책: 회장, 총무, 회계, 위원장, 부서장, 부서집사, 위원(집사는 아니지만 부서에서 봉사하는 성도를 칭함)
        DB::table('codes')->insert([ 'id' => 110001, 'code_category_id' => 11, 'order' =>  1, 'txt' => 'Chairperson', 'kor_txt' => '회장' ]);
        DB::table('codes')->insert([ 'id' => 110002, 'code_category_id' => 11, 'order' =>  2, 'txt' => 'Secretary', 'kor_txt' => '총무' ]);
        DB::table('codes')->insert([ 'id' => 110003, 'code_category_id' => 11, 'order' =>  3, 'txt' => 'Treasurer', 'kor_txt' => '회계' ]);
        DB::table('codes')->insert([ 'id' => 110004, 'code_category_id' => 11, 'order' =>  4, 'txt' => 'Committee Leader', 'kor_txt' => '위원장' ]);
        DB::table('codes')->insert([ 'id' => 110005, 'code_category_id' => 11, 'order' =>  5, 'txt' => 'Team Leader', 'kor_txt' => '부서장' ]);
        DB::table('codes')->insert([ 'id' => 110006, 'code_category_id' => 11, 'order' =>  6, 'txt' => 'Team Member', 'kor_txt' => '부서집사' ]);
        DB::table('codes')->insert([ 'id' => 110007, 'code_category_id' => 11, 'order' =>  7, 'txt' => 'Team Assistant', 'kor_txt' => '위원' ]);
        //--- 교구, 구역 편성에 관련한 직책
        DB::table('codes')->insert([ 'id' => 110101, 'code_category_id' => 11, 'order' =>  8, 'txt' => 'Gyogoo Leader', 'kor_txt' => '교구장' ]);
        DB::table('codes')->insert([ 'id' => 110102, 'code_category_id' => 11, 'order' =>  9, 'txt' => 'Gyogoo Kwonsa', 'kor_txt' => '교구권사' ]);
        DB::table('codes')->insert([ 'id' => 110103, 'code_category_id' => 11, 'order' => 10, 'txt' => 'Gooyeok Leader', 'kor_txt' => '구역장' ]);
        DB::table('codes')->insert([ 'id' => 110104, 'code_category_id' => 11, 'order' => 11, 'txt' => 'Gooyeok Member', 'kor_txt' => '구역원' ]);
        // 실제로 이하는 사용할 가능성이 매우적어 보이는 직책임 (거의 0%)...
        //--- 성가대
        DB::table('codes')->insert([ 'id' => 110201, 'code_category_id' => 11, 'order' => 12, 'txt' => 'Choir Leader', 'kor_txt' => '성가대장' ]);
        DB::table('codes')->insert([ 'id' => 110202, 'code_category_id' => 11, 'order' => 13, 'txt' => 'Conductor', 'kor_txt' => '지휘자' ]);
        DB::table('codes')->insert([ 'id' => 110203, 'code_category_id' => 11, 'order' => 14, 'txt' => 'Accompanist', 'kor_txt' => '반주자' ]);
        DB::table('codes')->insert([ 'id' => 110204, 'code_category_id' => 11, 'order' => 15, 'txt' => 'Choir Member', 'kor_txt' => '성가대원' ]);
        //--- 기타 봉사관련 직책: 특별위원회,교육부서 등...
        DB::table('codes')->insert([ 'id' => 110301, 'code_category_id' => 11, 'order' => 16, 'txt' => 'Teacher', 'kor_txt' => '교사' ]);
        DB::table('codes')->insert([ 'id' => 110302, 'code_category_id' => 11, 'order' => 17, 'txt' => 'Committee Leader', 'kor_txt' => '위원장' ]);
        DB::table('codes')->insert([ 'id' => 110303, 'code_category_id' => 11, 'order' => 18, 'txt' => 'Committee Member', 'kor_txt' => '위원' ]);
    }
}
