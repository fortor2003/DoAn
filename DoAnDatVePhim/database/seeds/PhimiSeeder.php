<?php

use Illuminate\Database\Seeder;

class PhimiSeeder extends Seeder
{

    public function run()
    {
        DB::delete('delete from phim');
        DB::table('phim')->insert([
            [ 'tieu_de_goc' => 'Gabriel\'s Inferno Part II', 'ten_phim' => 'Gabriel\'s Inferno Part II', 'diem_danh_gia' => 9.2, 'thoi_luong_chieu' => 0, 'quoc_gia_san_xuat' => '', 'nha_san_xuat' => 'PassionFlix', 'dao_dien' => 'Tosca Musk', 'dien_vien' => 'Melanie Zanetti, Giulio Berruti, James Andrew Fraser, Margaux Brooke, Agnes Albright, Purva Bedi, Sahar Bibiyan, Cedric Cannon, Ned Van Zandt', 'ngay_khoi_chieu' => '2020-07-31', 'noi_dung_phim' => '', 'anh_bia' => 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/3D0wcKWT5Unx3XbBiht5gcPWTxP.jpg', 'url_trailer_video' => '', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now() ]

        ]);
    }
}
