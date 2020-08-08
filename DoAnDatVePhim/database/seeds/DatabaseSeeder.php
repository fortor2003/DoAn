<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
         $this->call(TheLoaiSeeder::class);
         $this->call(PhimSeeder::class);
    }
}
