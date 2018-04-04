<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Code_CategoriesTableSeeder::class);
        $this->call(CodesTableSeeder::class);
    }
}
