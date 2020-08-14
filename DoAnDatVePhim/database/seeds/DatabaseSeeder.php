<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(KhungThoiGianSeeder::class);
        $this->call(RapSeeder::class);
        $this->call(PhongChieuSeeder::class);
        $this->call(GheSeeder::class);
        $this->call(TheLoaiSeeder::class);
        $this->call(PhimSeeder::class);
        $this->call(TaiKhoanSeeder::class);
    }
}
