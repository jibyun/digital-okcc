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
        // Member Status: 회원, 비정기출석, 장기결석, 해외거주, 이명, 사망, 전도대상자
        DB::table('codes')->insert([ 'id' => 10001, 'code_category_id' => 1, 'order' => 10001, 'txt' => 'Member', 'kor_txt' => '회원' ]);
        DB::table('codes')->insert([ 'id' => 10002, 'code_category_id' => 1, 'order' => 10002, 'txt' => 'Irregular Attendee', 'kor_txt' => '비정기출석' ]);
        DB::table('codes')->insert([ 'id' => 10003, 'code_category_id' => 1, 'order' => 10003, 'txt' => 'Long-term Absentee', 'kor_txt' => '장기결석' ]);
        DB::table('codes')->insert([ 'id' => 10004, 'code_category_id' => 1, 'order' => 10004, 'txt' => 'Overseas Resident', 'kor_txt' => '해외거주' ]);
        DB::table('codes')->insert([ 'id' => 10005, 'code_category_id' => 1, 'order' => 10005, 'txt' => 'Moved Church', 'kor_txt' => '이명' ]);
        DB::table('codes')->insert([ 'id' => 10006, 'code_category_id' => 1, 'order' => 10006, 'txt' => 'Pass Away', 'kor_txt' => '사망' ]);
        DB::table('codes')->insert([ 'id' => 10007, 'code_category_id' => 1, 'order' => 10007, 'txt' => 'Target of Evangelism', 'kor_txt' => '전도대상자' ]);

        // Duty: 교회직분 - 담임목사, 부목사, 목사, 전도사, 교육목사, 교육전도사, 시무장로, 은퇴장로, 권사, 은퇴권사, 집사, 협동장로, 협동권사, 위원
        DB::table('codes')->insert([ 'id' => 20001, 'code_category_id' => 2, 'order' => 20001, 'txt' => 'Senior Pastor', 'kor_txt' => '담임목사' ]);
        DB::table('codes')->insert([ 'id' => 20002, 'code_category_id' => 2, 'order' => 20002, 'txt' => 'Associate Pastor', 'kor_txt' => '부목사' ]);
        DB::table('codes')->insert([ 'id' => 20003, 'code_category_id' => 2, 'order' => 20003, 'txt' => 'Assitant Pastor', 'kor_txt' => '교육목사' ]);
        DB::table('codes')->insert([ 'id' => 20004, 'code_category_id' => 2, 'order' => 20004, 'txt' => 'Pastor', 'kor_txt' => '목사' ]);
        DB::table('codes')->insert([ 'id' => 20005, 'code_category_id' => 2, 'order' => 20005, 'txt' => 'Student Pastor', 'kor_txt' => '전도사' ]);
        DB::table('codes')->insert([ 'id' => 20006, 'code_category_id' => 2, 'order' => 20006, 'txt' => 'Elders', 'kor_txt' => '시무장로' ]);
        DB::table('codes')->insert([ 'id' => 20007, 'code_category_id' => 2, 'order' => 20007, 'txt' => 'Retired Elders', 'kor_txt' => '은퇴장로' ]);
        DB::table('codes')->insert([ 'id' => 20008, 'code_category_id' => 2, 'order' => 20008, 'txt' => 'Senior Deaconess', 'kor_txt' => '권사' ]);
        DB::table('codes')->insert([ 'id' => 20009, 'code_category_id' => 2, 'order' => 20009, 'txt' => 'Retired Senior Deaconess', 'kor_txt' => '은퇴권사' ]);
        DB::table('codes')->insert([ 'id' => 20010, 'code_category_id' => 2, 'order' => 20010, 'txt' => 'Deacon & Deaconess', 'kor_txt' => '집사' ]);
        DB::table('codes')->insert([ 'id' => 20011, 'code_category_id' => 2, 'order' => 20011, 'txt' => 'Cooperative Elder', 'kor_txt' => '협동장로' ]);
        DB::table('codes')->insert([ 'id' => 20012, 'code_category_id' => 2, 'order' => 20012, 'txt' => 'Cooperative Senior Deaconess', 'kor_txt' => '협동권사' ]);
        DB::table('codes')->insert([ 'id' => 20013, 'code_category_id' => 2, 'order' => 20013, 'txt' => 'Commissioner', 'kor_txt' => '위원' ]);
        DB::table('codes')->insert([ 'id' => 20014, 'code_category_id' => 2, 'order' => 20014, 'txt' => 'Laymen', 'kor_txt' => '평신도' ]);

        // Family Relations: 본인, 처, 자녀, 부모, 손주 
        DB::table('codes')->insert([ 'id' => 30001, 'code_category_id' => 3, 'order' => 30001, 'txt' => 'Householder', 'kor_txt' => '본인' ]);
        DB::table('codes')->insert([ 'id' => 30002, 'code_category_id' => 3, 'order' => 30002, 'txt' => 'Spouse', 'kor_txt' => '처' ]);
        DB::table('codes')->insert([ 'id' => 30003, 'code_category_id' => 3, 'order' => 30003, 'txt' => 'Children', 'kor_txt' => '자녀' ]);
        DB::table('codes')->insert([ 'id' => 30004, 'code_category_id' => 3, 'order' => 30004, 'txt' => 'Parent', 'kor_txt' => '부모' ]);
        DB::table('codes')->insert([ 'id' => 30005, 'code_category_id' => 3, 'order' => 30005, 'txt' => 'Grandchild', 'kor_txt' => '손주' ]);

        // Baptism Status: 세례, 유아세례, 입교, 영세
        DB::table('codes')->insert([ 'id' => 40001, 'code_category_id' => 4, 'order' => 40001, 'txt' => 'Baptism', 'kor_txt' => '세례' ]);
        DB::table('codes')->insert([ 'id' => 40002, 'code_category_id' => 4, 'order' => 40002, 'txt' => 'Infant Baptism', 'kor_txt' => '유아세례' ]);
        DB::table('codes')->insert([ 'id' => 40003, 'code_category_id' => 4, 'order' => 40003, 'txt' => 'Confirmation', 'kor_txt' => '입교' ]);
        DB::table('codes')->insert([ 'id' => 40004, 'code_category_id' => 4, 'order' => 40004, 'txt' => 'Unbaptized', 'kor_txt' => '무세' ]);

        // Department: 당회, 권사회, 집사회, 교육부, 성가대, 단기선교회, 남선교회, 제1여선교회, 제2여선교회 등
        DB::table('codes')->insert([ 'id' => 50001, 'code_category_id' => 5, 'order' => 50001, 'txt' => 'Session', 'kor_txt' => '당회' ]);
        DB::table('codes')->insert([ 'id' => 50002, 'code_category_id' => 5, 'order' => 50002, 'txt' => 'Senior Deaconess Meeting', 'kor_txt' => '권사회' ]);
        DB::table('codes')->insert([ 'id' => 50003, 'code_category_id' => 5, 'order' => 50003, 'txt' => 'Deacon Meeting', 'kor_txt' => '집사회' ]);
        DB::table('codes')->insert([ 'id' => 50004, 'code_category_id' => 5, 'order' => 50004, 'txt' => 'Administration Committee', 'kor_txt' => '관리위원회' ]);
        DB::table('codes')->insert([ 'id' => 50005, 'code_category_id' => 5, 'order' => 50005, 'txt' => 'Worship Committee', 'kor_txt' => '예배위원회' ]);
        DB::table('codes')->insert([ 'id' => 50006, 'code_category_id' => 5, 'order' => 50006, 'txt' => 'Education Committee', 'kor_txt' => '교육위원회' ]);
        DB::table('codes')->insert([ 'id' => 50007, 'code_category_id' => 5, 'order' => 50007, 'txt' => 'Missionary Committee', 'kor_txt' => '선교위원회' ]);
        DB::table('codes')->insert([ 'id' => 50008, 'code_category_id' => 5, 'order' => 50008, 'txt' => 'Fellowship Committee', 'kor_txt' => '친교위원회' ]);
        DB::table('codes')->insert([ 'id' => 50009, 'code_category_id' => 5, 'order' => 50009, 'txt' => 'Administration and Publication', 'kor_txt' => '서무출판부' ]);
        DB::table('codes')->insert([ 'id' => 50010, 'code_category_id' => 5, 'order' => 50010, 'txt' => 'Finance', 'kor_txt' => '재정부' ]);
        DB::table('codes')->insert([ 'id' => 50011, 'code_category_id' => 5, 'order' => 50011, 'txt' => 'Facility Management', 'kor_txt' => '시설부' ]);
        DB::table('codes')->insert([ 'id' => 50012, 'code_category_id' => 5, 'order' => 50012, 'txt' => 'Worship', 'kor_txt' => '예배부' ]);
        DB::table('codes')->insert([ 'id' => 50013, 'code_category_id' => 5, 'order' => 50013, 'txt' => 'Media', 'kor_txt' => '미디어부' ]);
        DB::table('codes')->insert([ 'id' => 50014, 'code_category_id' => 5, 'order' => 50014, 'txt' => 'Mahanaim Choir', 'kor_txt' => '마하나임성가대' ]);
        DB::table('codes')->insert([ 'id' => 50015, 'code_category_id' => 5, 'order' => 50015, 'txt' => 'Ainos', 'kor_txt' => '유치부:아이노스' ]);
        DB::table('codes')->insert([ 'id' => 50016, 'code_category_id' => 5, 'order' => 50016, 'txt' => 'Philoi', 'kor_txt' => '유초등부:필로이' ]);
        DB::table('codes')->insert([ 'id' => 50017, 'code_category_id' => 5, 'order' => 50017, 'txt' => 'Youth Ministry', 'kor_txt' => '청소년부:유스' ]);
        DB::table('codes')->insert([ 'id' => 50018, 'code_category_id' => 5, 'order' => 50018, 'txt' => 'Bahurim', 'kor_txt' => '청년부:바후림' ]);
        DB::table('codes')->insert([ 'id' => 50019, 'code_category_id' => 5, 'order' => 50019, 'txt' => 'MOSAIC', 'kor_txt' => '성인영어부' ]);
        DB::table('codes')->insert([ 'id' => 50020, 'code_category_id' => 5, 'order' => 50020, 'txt' => 'Adult School', 'kor_txt' => '성인교육부' ]);
        DB::table('codes')->insert([ 'id' => 50021, 'code_category_id' => 5, 'order' => 50021, 'txt' => 'Local Missionary', 'kor_txt' => '전도부' ]);
        DB::table('codes')->insert([ 'id' => 50022, 'code_category_id' => 5, 'order' => 50022, 'txt' => 'Charity', 'kor_txt' => '구제부' ]);
        DB::table('codes')->insert([ 'id' => 50023, 'code_category_id' => 5, 'order' => 50023, 'txt' => 'Multi-ethnic Missionary', 'kor_txt' => '다민족선교부' ]);
        DB::table('codes')->insert([ 'id' => 50024, 'code_category_id' => 5, 'order' => 50024, 'txt' => 'Overseas Missionary', 'kor_txt' => '해외선교부' ]);
        DB::table('codes')->insert([ 'id' => 50025, 'code_category_id' => 5, 'order' => 50025, 'txt' => 'Fellowship', 'kor_txt' => '친교부' ]);
        DB::table('codes')->insert([ 'id' => 50026, 'code_category_id' => 5, 'order' => 50026, 'txt' => 'New Members', 'kor_txt' => '새교우부' ]);
        DB::table('codes')->insert([ 'id' => 50027, 'code_category_id' => 5, 'order' => 50027, 'txt' => 'Diocese', 'kor_txt' => '교구' ]);
        DB::table('codes')->insert([ 'id' => 50028, 'code_category_id' => 5, 'order' => 50028, 'txt' => 'Cell', 'kor_txt' => '구역' ]);
        DB::table('codes')->insert([ 'id' => 50029, 'code_category_id' => 5, 'order' => 50029, 'txt' => "Men's Missonary Group", 'kor_txt' => '남선교회' ]);
        DB::table('codes')->insert([ 'id' => 50030, 'code_category_id' => 5, 'order' => 50030, 'txt' => "1st Women's Missonary Group", 'kor_txt' => '제1여선교회' ]);
        DB::table('codes')->insert([ 'id' => 50031, 'code_category_id' => 5, 'order' => 50031, 'txt' => "2nd Women's Missonary Group", 'kor_txt' => '제2여선교회' ]);

        // City 
        DB::table('codes')->insert([ 'id' => 60001, 'code_category_id' => 6, 'order' => 60001, 'txt' => 'Airdrie', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60002, 'code_category_id' => 6, 'order' => 60002, 'txt' => 'Brooks', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60003, 'code_category_id' => 6, 'order' => 60003, 'txt' => 'Calgary', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60004, 'code_category_id' => 6, 'order' => 60004, 'txt' => 'Camrose', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60005, 'code_category_id' => 6, 'order' => 60005, 'txt' => 'Chestermere', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60006, 'code_category_id' => 6, 'order' => 60006, 'txt' => 'Cold Lake', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60007, 'code_category_id' => 6, 'order' => 60007, 'txt' => 'Edmonton', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60008, 'code_category_id' => 6, 'order' => 60008, 'txt' => 'Fort Saskatchewan', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60009, 'code_category_id' => 6, 'order' => 60009, 'txt' => 'Grande Prairie', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60010, 'code_category_id' => 6, 'order' => 60010, 'txt' => 'Lacombe', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60011, 'code_category_id' => 6, 'order' => 60011, 'txt' => 'Leduc', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60012, 'code_category_id' => 6, 'order' => 60012, 'txt' => 'Lethbridge', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60013, 'code_category_id' => 6, 'order' => 60013, 'txt' => 'Lloydminster', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60014, 'code_category_id' => 6, 'order' => 60014, 'txt' => 'Medicine Hat', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60015, 'code_category_id' => 6, 'order' => 60015, 'txt' => 'Red Deer', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60016, 'code_category_id' => 6, 'order' => 60016, 'txt' => 'Spruce Grove', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60017, 'code_category_id' => 6, 'order' => 60017, 'txt' => 'St. Albert', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60018, 'code_category_id' => 6, 'order' => 60018, 'txt' => 'Wetaskiwin', 'kor_txt' => 'AB' ]);
        DB::table('codes')->insert([ 'id' => 60019, 'code_category_id' => 6, 'order' => 60019, 'txt' => 'Abbotsford', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60020, 'code_category_id' => 6, 'order' => 60020, 'txt' => 'Armstrong', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60021, 'code_category_id' => 6, 'order' => 60021, 'txt' => 'Burnaby', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60022, 'code_category_id' => 6, 'order' => 60022, 'txt' => 'Campbell River', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60023, 'code_category_id' => 6, 'order' => 60023, 'txt' => 'Castlegar', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60024, 'code_category_id' => 6, 'order' => 60024, 'txt' => 'Chilliwack', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60025, 'code_category_id' => 6, 'order' => 60025, 'txt' => 'Colwood', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60026, 'code_category_id' => 6, 'order' => 60026, 'txt' => 'Coquitlam', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60027, 'code_category_id' => 6, 'order' => 60027, 'txt' => 'Courtenay', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60028, 'code_category_id' => 6, 'order' => 60028, 'txt' => 'Cranbrook', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60029, 'code_category_id' => 6, 'order' => 60029, 'txt' => 'Dawson Creek', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60030, 'code_category_id' => 6, 'order' => 60030, 'txt' => 'Delta', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60031, 'code_category_id' => 6, 'order' => 60031, 'txt' => 'Duncan', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60032, 'code_category_id' => 6, 'order' => 60032, 'txt' => 'Enderby', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60033, 'code_category_id' => 6, 'order' => 60033, 'txt' => 'Fernie', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60034, 'code_category_id' => 6, 'order' => 60034, 'txt' => 'Fort St. John', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60035, 'code_category_id' => 6, 'order' => 60035, 'txt' => 'Grand Forks', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60036, 'code_category_id' => 6, 'order' => 60036, 'txt' => 'Greenwood', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60037, 'code_category_id' => 6, 'order' => 60037, 'txt' => 'Kamloops', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60038, 'code_category_id' => 6, 'order' => 60038, 'txt' => 'Kelowna', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60039, 'code_category_id' => 6, 'order' => 60039, 'txt' => 'Kimberley', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60040, 'code_category_id' => 6, 'order' => 60040, 'txt' => 'Langford', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60041, 'code_category_id' => 6, 'order' => 60041, 'txt' => 'Langley', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60042, 'code_category_id' => 6, 'order' => 60042, 'txt' => 'Maple Ridge', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60043, 'code_category_id' => 6, 'order' => 60043, 'txt' => 'Merritt', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60044, 'code_category_id' => 6, 'order' => 60044, 'txt' => 'Nanaimo', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60045, 'code_category_id' => 6, 'order' => 60045, 'txt' => 'Nelson', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60046, 'code_category_id' => 6, 'order' => 60046, 'txt' => 'New Westminster', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60047, 'code_category_id' => 6, 'order' => 60047, 'txt' => 'North Vancouver', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60048, 'code_category_id' => 6, 'order' => 60048, 'txt' => 'Parksville', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60049, 'code_category_id' => 6, 'order' => 60049, 'txt' => 'Penticton', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60050, 'code_category_id' => 6, 'order' => 60050, 'txt' => 'Pitt Meadows', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60051, 'code_category_id' => 6, 'order' => 60051, 'txt' => 'Port Alberni', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60052, 'code_category_id' => 6, 'order' => 60052, 'txt' => 'Port Coquitlam', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60053, 'code_category_id' => 6, 'order' => 60053, 'txt' => 'Port Moody', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60054, 'code_category_id' => 6, 'order' => 60054, 'txt' => 'Powell River', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60055, 'code_category_id' => 6, 'order' => 60055, 'txt' => 'Prince George', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60056, 'code_category_id' => 6, 'order' => 60056, 'txt' => 'Prince Rupert', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60057, 'code_category_id' => 6, 'order' => 60057, 'txt' => 'Quesnel', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60058, 'code_category_id' => 6, 'order' => 60058, 'txt' => 'Revelstoke', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60059, 'code_category_id' => 6, 'order' => 60059, 'txt' => 'Richmond', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60060, 'code_category_id' => 6, 'order' => 60060, 'txt' => 'Rossland', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60061, 'code_category_id' => 6, 'order' => 60061, 'txt' => 'Salmon Arm', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60062, 'code_category_id' => 6, 'order' => 60062, 'txt' => 'Surrey', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60063, 'code_category_id' => 6, 'order' => 60063, 'txt' => 'Terrace', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60064, 'code_category_id' => 6, 'order' => 60064, 'txt' => 'Trail', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60065, 'code_category_id' => 6, 'order' => 60065, 'txt' => 'Vancouver', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60066, 'code_category_id' => 6, 'order' => 60066, 'txt' => 'Vernon', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60067, 'code_category_id' => 6, 'order' => 60067, 'txt' => 'Victoria', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60068, 'code_category_id' => 6, 'order' => 60068, 'txt' => 'West Kelowna', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60069, 'code_category_id' => 6, 'order' => 60069, 'txt' => 'White Rock', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60070, 'code_category_id' => 6, 'order' => 60070, 'txt' => 'Williams Lake', 'kor_txt' => 'BC' ]);
        DB::table('codes')->insert([ 'id' => 60071, 'code_category_id' => 6, 'order' => 60071, 'txt' => 'Brandon', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60072, 'code_category_id' => 6, 'order' => 60072, 'txt' => 'Dauphin', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60073, 'code_category_id' => 6, 'order' => 60073, 'txt' => 'Flin Flon', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60074, 'code_category_id' => 6, 'order' => 60074, 'txt' => 'Morden', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60075, 'code_category_id' => 6, 'order' => 60075, 'txt' => 'Portage la Prairie', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60076, 'code_category_id' => 6, 'order' => 60076, 'txt' => 'Selkirk', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60077, 'code_category_id' => 6, 'order' => 60077, 'txt' => 'Steinbach', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60078, 'code_category_id' => 6, 'order' => 60078, 'txt' => 'Thompson', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60079, 'code_category_id' => 6, 'order' => 60079, 'txt' => 'Winkler', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60080, 'code_category_id' => 6, 'order' => 60080, 'txt' => 'Winnipeg', 'kor_txt' => 'MB' ]);
        DB::table('codes')->insert([ 'id' => 60081, 'code_category_id' => 6, 'order' => 60081, 'txt' => 'Bathurst', 'kor_txt' => 'NB' ]);
        DB::table('codes')->insert([ 'id' => 60082, 'code_category_id' => 6, 'order' => 60082, 'txt' => 'Campbellton', 'kor_txt' => 'NB' ]);
        DB::table('codes')->insert([ 'id' => 60083, 'code_category_id' => 6, 'order' => 60083, 'txt' => 'Dieppe', 'kor_txt' => 'NB' ]);
        DB::table('codes')->insert([ 'id' => 60084, 'code_category_id' => 6, 'order' => 60084, 'txt' => 'Edmundston', 'kor_txt' => 'NB' ]);
        DB::table('codes')->insert([ 'id' => 60085, 'code_category_id' => 6, 'order' => 60085, 'txt' => 'Fredericton', 'kor_txt' => 'NB' ]);
        DB::table('codes')->insert([ 'id' => 60086, 'code_category_id' => 6, 'order' => 60086, 'txt' => 'Miramichi', 'kor_txt' => 'NB' ]);
        DB::table('codes')->insert([ 'id' => 60087, 'code_category_id' => 6, 'order' => 60087, 'txt' => 'Moncton', 'kor_txt' => 'NB' ]);
        DB::table('codes')->insert([ 'id' => 60088, 'code_category_id' => 6, 'order' => 60088, 'txt' => 'Saint John', 'kor_txt' => 'NB' ]);
        DB::table('codes')->insert([ 'id' => 60089, 'code_category_id' => 6, 'order' => 60089, 'txt' => 'Corner Brook', 'kor_txt' => 'NL' ]);
        DB::table('codes')->insert([ 'id' => 60090, 'code_category_id' => 6, 'order' => 60090, 'txt' => 'Mount Pearl', 'kor_txt' => 'NL' ]);
        DB::table('codes')->insert([ 'id' => 60091, 'code_category_id' => 6, 'order' => 60091, 'txt' => "St. John's", 'kor_txt' => 'NL' ]);
        DB::table('codes')->insert([ 'id' => 60092, 'code_category_id' => 6, 'order' => 60092, 'txt' => 'Dartmouth', 'kor_txt' => 'NS' ]);
        DB::table('codes')->insert([ 'id' => 60093, 'code_category_id' => 6, 'order' => 60093, 'txt' => 'Halifax', 'kor_txt' => 'NS' ]);
        DB::table('codes')->insert([ 'id' => 60094, 'code_category_id' => 6, 'order' => 60094, 'txt' => 'Sydney', 'kor_txt' => 'NS' ]);
        DB::table('codes')->insert([ 'id' => 60095, 'code_category_id' => 6, 'order' => 60095, 'txt' => 'Yellowknife', 'kor_txt' => 'NT' ]);
        DB::table('codes')->insert([ 'id' => 60096, 'code_category_id' => 6, 'order' => 60096, 'txt' => 'Iqaluit', 'kor_txt' => 'NU' ]);
        DB::table('codes')->insert([ 'id' => 60097, 'code_category_id' => 6, 'order' => 60097, 'txt' => 'Algonquin Provincial Park', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60098, 'code_category_id' => 6, 'order' => 60098, 'txt' => 'Almonte', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60099, 'code_category_id' => 6, 'order' => 60099, 'txt' => 'Arnprior', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60100, 'code_category_id' => 6, 'order' => 60100, 'txt' => 'Barrhaven', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60101, 'code_category_id' => 6, 'order' => 60101, 'txt' => 'Barrie', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60102, 'code_category_id' => 6, 'order' => 60102, 'txt' => "Barry's Bay", 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60103, 'code_category_id' => 6, 'order' => 60103, 'txt' => 'Belleville', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60104, 'code_category_id' => 6, 'order' => 60104, 'txt' => 'Brampton', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60105, 'code_category_id' => 6, 'order' => 60105, 'txt' => 'Brant', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60106, 'code_category_id' => 6, 'order' => 60106, 'txt' => 'Brantford', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60107, 'code_category_id' => 6, 'order' => 60107, 'txt' => 'Brockville', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60108, 'code_category_id' => 6, 'order' => 60108, 'txt' => 'Burlington', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60109, 'code_category_id' => 6, 'order' => 60109, 'txt' => 'Cambridge', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60110, 'code_category_id' => 6, 'order' => 60110, 'txt' => 'Carp', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60111, 'code_category_id' => 6, 'order' => 60111, 'txt' => 'Carp', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60112, 'code_category_id' => 6, 'order' => 60112, 'txt' => 'Chalk River', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60113, 'code_category_id' => 6, 'order' => 60113, 'txt' => 'Clarence-Rockland', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60114, 'code_category_id' => 6, 'order' => 60114, 'txt' => 'Cobden', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60115, 'code_category_id' => 6, 'order' => 60115, 'txt' => 'Cornwall', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60116, 'code_category_id' => 6, 'order' => 60116, 'txt' => 'Deep River', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60117, 'code_category_id' => 6, 'order' => 60117, 'txt' => 'Dryden', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60118, 'code_category_id' => 6, 'order' => 60118, 'txt' => 'Dunrobin', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60119, 'code_category_id' => 6, 'order' => 60119, 'txt' => 'Elliot Lake', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60120, 'code_category_id' => 6, 'order' => 60120, 'txt' => 'Fitzroy Harbour', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60121, 'code_category_id' => 6, 'order' => 60121, 'txt' => 'Greater Sudbury', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60122, 'code_category_id' => 6, 'order' => 60122, 'txt' => 'Guelph', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60123, 'code_category_id' => 6, 'order' => 60123, 'txt' => 'Haldimand County', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60124, 'code_category_id' => 6, 'order' => 60124, 'txt' => 'Hamilton', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60125, 'code_category_id' => 6, 'order' => 60125, 'txt' => 'Kanata', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60126, 'code_category_id' => 6, 'order' => 60126, 'txt' => 'Kawartha Lakes', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60127, 'code_category_id' => 6, 'order' => 60127, 'txt' => 'Kemptville', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60128, 'code_category_id' => 6, 'order' => 60128, 'txt' => 'Kemptville', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60129, 'code_category_id' => 6, 'order' => 60129, 'txt' => 'Kenora', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60130, 'code_category_id' => 6, 'order' => 60130, 'txt' => 'Kingston', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60131, 'code_category_id' => 6, 'order' => 60131, 'txt' => 'Kitchener', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60132, 'code_category_id' => 6, 'order' => 60132, 'txt' => 'London', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60133, 'code_category_id' => 6, 'order' => 60133, 'txt' => 'Manotick', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60134, 'code_category_id' => 6, 'order' => 60134, 'txt' => 'Markham', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60135, 'code_category_id' => 6, 'order' => 60135, 'txt' => 'Mattawa', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60136, 'code_category_id' => 6, 'order' => 60136, 'txt' => 'Merrickville', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60137, 'code_category_id' => 6, 'order' => 60137, 'txt' => 'Mississauga', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60138, 'code_category_id' => 6, 'order' => 60138, 'txt' => 'Nepean', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60139, 'code_category_id' => 6, 'order' => 60139, 'txt' => 'Niagara Falls', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60140, 'code_category_id' => 6, 'order' => 60140, 'txt' => 'Norfolk County', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60141, 'code_category_id' => 6, 'order' => 60141, 'txt' => 'North Bay', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60142, 'code_category_id' => 6, 'order' => 60142, 'txt' => 'Orillia', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60143, 'code_category_id' => 6, 'order' => 60143, 'txt' => 'Orleans', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60144, 'code_category_id' => 6, 'order' => 60144, 'txt' => 'Oshawa', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60145, 'code_category_id' => 6, 'order' => 60145, 'txt' => 'Ottawa', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60146, 'code_category_id' => 6, 'order' => 60146, 'txt' => 'Owen Sound', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60147, 'code_category_id' => 6, 'order' => 60147, 'txt' => 'Pembroke', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60148, 'code_category_id' => 6, 'order' => 60148, 'txt' => 'Pembroke', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60149, 'code_category_id' => 6, 'order' => 60149, 'txt' => 'Perth', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60150, 'code_category_id' => 6, 'order' => 60150, 'txt' => 'Petawawa', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60151, 'code_category_id' => 6, 'order' => 60151, 'txt' => 'Peterborough', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60152, 'code_category_id' => 6, 'order' => 60152, 'txt' => 'Pickering', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60153, 'code_category_id' => 6, 'order' => 60153, 'txt' => 'Port Colborne', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60154, 'code_category_id' => 6, 'order' => 60154, 'txt' => 'Prince Edward County', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60155, 'code_category_id' => 6, 'order' => 60155, 'txt' => 'Quinte West', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60156, 'code_category_id' => 6, 'order' => 60156, 'txt' => 'Renfrew', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60157, 'code_category_id' => 6, 'order' => 60157, 'txt' => 'Sarnia', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60158, 'code_category_id' => 6, 'order' => 60158, 'txt' => 'Sault Ste. Marie', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60159, 'code_category_id' => 6, 'order' => 60159, 'txt' => 'Smiths Falls', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60160, 'code_category_id' => 6, 'order' => 60160, 'txt' => 'St. Catharines', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60161, 'code_category_id' => 6, 'order' => 60161, 'txt' => 'St. Thomas', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60162, 'code_category_id' => 6, 'order' => 60162, 'txt' => 'Stittsville', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60163, 'code_category_id' => 6, 'order' => 60163, 'txt' => 'Stratford', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60164, 'code_category_id' => 6, 'order' => 60164, 'txt' => 'Temiskaming Shores', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60165, 'code_category_id' => 6, 'order' => 60165, 'txt' => 'Thorold', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60166, 'code_category_id' => 6, 'order' => 60166, 'txt' => 'Thunder Bay', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60167, 'code_category_id' => 6, 'order' => 60167, 'txt' => 'Timmins', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60168, 'code_category_id' => 6, 'order' => 60168, 'txt' => 'Toronto', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60169, 'code_category_id' => 6, 'order' => 60169, 'txt' => 'Vaughan', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60170, 'code_category_id' => 6, 'order' => 60170, 'txt' => 'Waterloo', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60171, 'code_category_id' => 6, 'order' => 60171, 'txt' => 'Welland', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60172, 'code_category_id' => 6, 'order' => 60172, 'txt' => 'Westboro', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60173, 'code_category_id' => 6, 'order' => 60173, 'txt' => 'Windsor', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60174, 'code_category_id' => 6, 'order' => 60174, 'txt' => 'Woodstock', 'kor_txt' => 'ON' ]);
        DB::table('codes')->insert([ 'id' => 60175, 'code_category_id' => 6, 'order' => 60175, 'txt' => 'Charlottetown', 'kor_txt' => 'PE' ]);
        DB::table('codes')->insert([ 'id' => 60176, 'code_category_id' => 6, 'order' => 60176, 'txt' => 'Summerside', 'kor_txt' => 'PE' ]);
        DB::table('codes')->insert([ 'id' => 60177, 'code_category_id' => 6, 'order' => 60177, 'txt' => 'Buckingham', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60178, 'code_category_id' => 6, 'order' => 60178, 'txt' => 'Cantley', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60179, 'code_category_id' => 6, 'order' => 60179, 'txt' => 'Carillon', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60180, 'code_category_id' => 6, 'order' => 60180, 'txt' => 'Chicoutimi', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60181, 'code_category_id' => 6, 'order' => 60181, 'txt' => 'Fort Coulonge', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60182, 'code_category_id' => 6, 'order' => 60182, 'txt' => 'Gatineau', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60183, 'code_category_id' => 6, 'order' => 60183, 'txt' => 'Hull', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60184, 'code_category_id' => 6, 'order' => 60184, 'txt' => 'Maniwaki', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60185, 'code_category_id' => 6, 'order' => 60185, 'txt' => 'Montreal', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60186, 'code_category_id' => 6, 'order' => 60186, 'txt' => 'Papineauville', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60187, 'code_category_id' => 6, 'order' => 60187, 'txt' => 'Quebec City', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60188, 'code_category_id' => 6, 'order' => 60188, 'txt' => 'Wakefield', 'kor_txt' => 'QC' ]);
        DB::table('codes')->insert([ 'id' => 60189, 'code_category_id' => 6, 'order' => 60189, 'txt' => 'Estevan', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60190, 'code_category_id' => 6, 'order' => 60190, 'txt' => 'Humboldt', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60191, 'code_category_id' => 6, 'order' => 60191, 'txt' => 'Martensville', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60192, 'code_category_id' => 6, 'order' => 60192, 'txt' => 'Meadow Lake', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60193, 'code_category_id' => 6, 'order' => 60193, 'txt' => 'Melfort', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60194, 'code_category_id' => 6, 'order' => 60194, 'txt' => 'Melville', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60195, 'code_category_id' => 6, 'order' => 60195, 'txt' => 'North Battleford', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60196, 'code_category_id' => 6, 'order' => 60196, 'txt' => 'Prince Albert', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60197, 'code_category_id' => 6, 'order' => 60197, 'txt' => 'Regina', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60198, 'code_category_id' => 6, 'order' => 60198, 'txt' => 'Saskatoon', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60199, 'code_category_id' => 6, 'order' => 60199, 'txt' => 'Swift Current', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60200, 'code_category_id' => 6, 'order' => 60200, 'txt' => 'Warman', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60201, 'code_category_id' => 6, 'order' => 60201, 'txt' => 'Weyburn', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60202, 'code_category_id' => 6, 'order' => 60202, 'txt' => 'Yorkton', 'kor_txt' => 'SK' ]);
        DB::table('codes')->insert([ 'id' => 60203, 'code_category_id' => 6, 'order' => 60203, 'txt' => 'Whitehorse', 'kor_txt' => 'YT' ]);
        DB::table('codes')->insert([ 'id' => 60204, 'code_category_id' => 6, 'order' => 60204, 'txt' => 'Carleton Place', 'kor_txt' => 'ON' ]);

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
        DB::table('codes')->insert([ 'id' => 90001, 'code_category_id' => 9, 'order' => 1, 'txt' => '1Kyogu', 'kor_txt' => '1교구' ]);
        DB::table('codes')->insert([ 'id' => 90002, 'code_category_id' => 9, 'order' => 2, 'txt' => '2Kyogu', 'kor_txt' => '2교구' ]);
        DB::table('codes')->insert([ 'id' => 90003, 'code_category_id' => 9, 'order' => 3, 'txt' => '3Kyogu', 'kor_txt' => '3교구' ]);
        DB::table('codes')->insert([ 'id' => 90004, 'code_category_id' => 9, 'order' => 4, 'txt' => '4Kyogu', 'kor_txt' => '4교구' ]);
        DB::table('codes')->insert([ 'id' => 90005, 'code_category_id' => 9, 'order' => 5, 'txt' => '5Kyogu', 'kor_txt' => '5교구' ]);
        DB::table('codes')->insert([ 'id' => 90006, 'code_category_id' => 9, 'order' => 6, 'txt' => '6Kyogu', 'kor_txt' => '6교구' ]);

        // 구역
        DB::table('codes')->insert([ 'id' => 100001, 'code_category_id' => 10, 'order' => 1, 'txt' => '1Guyeok', 'kor_txt' => '1구역' ]);
        DB::table('codes')->insert([ 'id' => 100002, 'code_category_id' => 10, 'order' => 2, 'txt' => '2Guyeok', 'kor_txt' => '2구역' ]);
        DB::table('codes')->insert([ 'id' => 100003, 'code_category_id' => 10, 'order' => 3, 'txt' => '3Guyeok', 'kor_txt' => '3구역' ]);
        DB::table('codes')->insert([ 'id' => 100004, 'code_category_id' => 10, 'order' => 4, 'txt' => '4Guyeok', 'kor_txt' => '4구역' ]);
        DB::table('codes')->insert([ 'id' => 100005, 'code_category_id' => 10, 'order' => 5, 'txt' => '5Guyeok', 'kor_txt' => '5구역' ]);
        DB::table('codes')->insert([ 'id' => 100006, 'code_category_id' => 10, 'order' => 6, 'txt' => '6Guyeok', 'kor_txt' => '6구역' ]);
        DB::table('codes')->insert([ 'id' => 100007, 'code_category_id' => 10, 'order' => 7, 'txt' => '7Guyeok', 'kor_txt' => '7구역' ]);
        DB::table('codes')->insert([ 'id' => 100008, 'code_category_id' => 10, 'order' => 8, 'txt' => '8Guyeok', 'kor_txt' => '8구역' ]);
        DB::table('codes')->insert([ 'id' => 100009, 'code_category_id' => 10, 'order' => 9, 'txt' => '9Guyeok', 'kor_txt' => '9구역' ]);
        DB::table('codes')->insert([ 'id' => 100010, 'code_category_id' => 10, 'order' => 10, 'txt' => '10Guyeok', 'kor_txt' => '10구역' ]);
        DB::table('codes')->insert([ 'id' => 100011, 'code_category_id' => 10, 'order' => 11, 'txt' => '11Guyeok', 'kor_txt' => '11구역' ]);
        DB::table('codes')->insert([ 'id' => 100012, 'code_category_id' => 10, 'order' => 12, 'txt' => '12Guyeok', 'kor_txt' => '12구역' ]);
        DB::table('codes')->insert([ 'id' => 100013, 'code_category_id' => 10, 'order' => 13, 'txt' => '13Guyeok', 'kor_txt' => '13구역' ]);
        DB::table('codes')->insert([ 'id' => 100014, 'code_category_id' => 10, 'order' => 14, 'txt' => '14Guyeok', 'kor_txt' => '14구역' ]);
        DB::table('codes')->insert([ 'id' => 100015, 'code_category_id' => 10, 'order' => 15, 'txt' => '15Guyeok', 'kor_txt' => '15구역' ]);
        DB::table('codes')->insert([ 'id' => 100016, 'code_category_id' => 10, 'order' => 16, 'txt' => '16Guyeok', 'kor_txt' => '16구역' ]);
        DB::table('codes')->insert([ 'id' => 100017, 'code_category_id' => 10, 'order' => 17, 'txt' => '17Guyeok', 'kor_txt' => '17구역' ]);
        DB::table('codes')->insert([ 'id' => 100018, 'code_category_id' => 10, 'order' => 18, 'txt' => '18Guyeok', 'kor_txt' => '18구역' ]);
        DB::table('codes')->insert([ 'id' => 100019, 'code_category_id' => 10, 'order' => 19, 'txt' => '19Guyeok', 'kor_txt' => '19구역' ]);
        DB::table('codes')->insert([ 'id' => 100020, 'code_category_id' => 10, 'order' => 20, 'txt' => '20Guyeok', 'kor_txt' => '20구역' ]);
        DB::table('codes')->insert([ 'id' => 100021, 'code_category_id' => 10, 'order' => 21, 'txt' => '21Guyeok', 'kor_txt' => '21구역' ]);
        DB::table('codes')->insert([ 'id' => 100022, 'code_category_id' => 10, 'order' => 22, 'txt' => '22Guyeok', 'kor_txt' => '22구역' ]);
        DB::table('codes')->insert([ 'id' => 100023, 'code_category_id' => 10, 'order' => 23, 'txt' => '23Guyeok', 'kor_txt' => '23구역' ]);
        DB::table('codes')->insert([ 'id' => 100024, 'code_category_id' => 10, 'order' => 24, 'txt' => '24Guyeok', 'kor_txt' => '24구역' ]);
        DB::table('codes')->insert([ 'id' => 100025, 'code_category_id' => 10, 'order' => 25, 'txt' => '25Guyeok', 'kor_txt' => '25구역' ]);

        // LOG
        DB::table('codes')->insert([ 'id' => 110001, 'code_category_id' => 11, 'order' => 1, 'txt' => 'LOGIN', 'kor_txt' => '로그인' ]);
        DB::table('codes')->insert([ 'id' => 110002, 'code_category_id' => 11, 'order' => 2, 'txt' => 'LOGOUT', 'kor_txt' => '로그아웃' ]);
        DB::table('codes')->insert([ 'id' => 110003, 'code_category_id' => 11, 'order' => 3, 'txt' => 'INSERT', 'kor_txt' => '추가' ]);
        DB::table('codes')->insert([ 'id' => 110004, 'code_category_id' => 11, 'order' => 4, 'txt' => 'UPDATE', 'kor_txt' => '수정' ]);
        DB::table('codes')->insert([ 'id' => 110005, 'code_category_id' => 11, 'order' => 5, 'txt' => 'DELETE', 'kor_txt' => '삭제' ]);

        // POSITION
        DB::table('codes')->insert([ 'id' => 120001, 'code_category_id' => 12, 'order' => 1, 'txt' => 'President', 'kor_txt' => '회장' ]);
        DB::table('codes')->insert([ 'id' => 120002, 'code_category_id' => 12, 'order' => 2, 'txt' => 'Vice President', 'kor_txt' => '부회장' ]);
        DB::table('codes')->insert([ 'id' => 120003, 'code_category_id' => 12, 'order' => 3, 'txt' => 'Supervisor', 'kor_txt' => '부서장' ]);
        DB::table('codes')->insert([ 'id' => 120004, 'code_category_id' => 12, 'order' => 4, 'txt' => 'Director', 'kor_txt' => '총무' ]);
        DB::table('codes')->insert([ 'id' => 120005, 'code_category_id' => 12, 'order' => 5, 'txt' => 'Accoundant', 'kor_txt' => '회계' ]);
        DB::table('codes')->insert([ 'id' => 120006, 'code_category_id' => 12, 'order' => 6, 'txt' => 'Teacher', 'kor_txt' => '교사' ]);
        DB::table('codes')->insert([ 'id' => 120007, 'code_category_id' => 12, 'order' => 7, 'txt' => 'Great Cell Leader', 'kor_txt' => '교구장' ]);
        DB::table('codes')->insert([ 'id' => 120008, 'code_category_id' => 12, 'order' => 8, 'txt' => 'Cell Leader', 'kor_txt' => '구역장' ]);
        DB::table('codes')->insert([ 'id' => 120009, 'code_category_id' => 12, 'order' => 9, 'txt' => 'Choir Team Leader', 'kor_txt' => '성가대장' ]);
        DB::table('codes')->insert([ 'id' => 120010, 'code_category_id' => 12, 'order' => 10, 'txt' => 'Conductor', 'kor_txt' => '지휘자' ]);
        DB::table('codes')->insert([ 'id' => 120011, 'code_category_id' => 12, 'order' => 11, 'txt' => 'Accompanist', 'kor_txt' => '반주자' ]);
        DB::table('codes')->insert([ 'id' => 120012, 'code_category_id' => 12, 'order' => 12, 'txt' => 'Member', 'kor_txt' => '팀원' ]);
    }
}
