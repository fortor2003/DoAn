<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TheLoaiSeeder extends Seeder
{

    public function run()
    {
        $genres = json_decode(Storage::disk('local')->get('genres.json'));
        DB::delete('delete from the_loai');
        DB::table('the_loai')->insert(
            array_map(function ($item) {
                return [
                    'external_id' => $item->externalId,
                    'ten_the_loai' => $item->tenTheLoai,
                    'thoi_diem_tao' => now(),
                    'thoi_diem_cap_nhat' => now()
                ];
            }, $genres)
        );
    }
}
