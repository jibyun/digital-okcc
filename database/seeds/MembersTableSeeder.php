<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $canFaker = Faker::create('en_CA');
        $korFaker = Faker::create('ko_KR');
        foreach (range(1, 300) as $index) {
            DB::table('members')->insert([
                'first_name' => $canFaker->firstName($gender = 'M'|'F'),
                'middle_name' => '',
                'last_name' => $canFaker->lastName(),
                'kor_name' => $korFaker->name(),
                'dob' => $canFaker->date($format = 'Y-m-d', $max = 'now'),
                'gender' => $canFaker->randomElement($array = array ('M','F')),
                'email' => $canFaker->safeEmail(),
                'tel_home' => $canFaker->phoneNumber(),
                'tel_office' => $canFaker->phoneNumber(),
                'tel_cell' => $canFaker->phoneNumber(),
                'address' => $canFaker->streetAddress(),
                'postal_code' => $this->randomPostalCode(),
                'photo' => '',
                'primary' => (bool)random_int(0, 1),
                'city_id' => $canFaker->numberBetween($min = 60001, $max = 60204),
                'province_id' => $canFaker->numberBetween($min = 70001, $max = 70013),
                'country_id' => 80001,
                'status_id' => $canFaker->numberBetween($min = 10001, $max = 10006),
                'level_id' => $canFaker->numberBetween($min = 40001, $max = 40003),
                'duty_id' => $canFaker->numberBetween($min = 20001, $max = 20013),
                'register_at' => $canFaker->dateTime($max = 'now', $timezone = null),
                'baptism_at' => $canFaker->dateTime($max = 'now', $timezone = null),
                'created_at' => $canFaker->dateTime($max = 'now', $timezone = null),
                'updated_at' => $canFaker->dateTime($max = 'now', $timezone = null),
            ]);
        }
    }
    
    private function randomPostalCode() 
    {
        $tbl1 = range('0','9');
        $tbl2 = range('A','Z');
        $base = '';
        $base .= $tbl2[mt_rand(0, count($tbl2) - 1)];
        $base .= $tbl1[mt_rand(0, count($tbl1) - 1)];
        $base .= $tbl2[mt_rand(0, count($tbl2) - 1)];
        $base .= $tbl1[mt_rand(0, count($tbl1) - 1)];
        $base .= $tbl2[mt_rand(0, count($tbl2) - 1)];
        $base .= $tbl1[mt_rand(0, count($tbl1) - 1)];
        return $base;
    }
}
