<?php

use Illuminate\Database\Seeder;

class TheLoaiSeeder extends Seeder
{

    public function run()
    {
        DB::delete('delete from the_loai');
        DB::table('the_loai')->insert([
            ['id' => 28, 'ten_the_loai' => 'Phim Hành Động', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()],
            ['id' => 12, 'ten_the_loai' => 'Phim Phiêu Lưu', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()],
            ['id' => 16, 'ten_the_loai' => 'Phim Hoạt Hình', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()],
            ['id' => 35, 'ten_the_loai' => 'Phim Hài', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()],
            ['id' => 80, 'ten_the_loai' => 'Phim Hình Sự', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()],
            ['id' => 99, 'ten_the_loai' => 'Phim Tài Liệu', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()],
            ['id' => 18, 'ten_the_loai' => 'Phim Chính Kịch', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()],
            ['id' => 10751, 'ten_the_loai' => 'Phim Gia Đình', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()],
            ['id' => 14, 'ten_the_loai' => 'Phim Giả Tượng', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()],
            ['id' => 36, 'ten_the_loai' => 'Phim Lịch Sử', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()],
            ['id' => 27, 'ten_the_loai' => 'Phim Kinh Dị', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()],
            ['id' => 10402, 'ten_the_loai' => 'Phim Nhạc', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()],
            ['id' => 9648, 'ten_the_loai' => 'Phim Bí Ẩn', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()],
            ['id' => 10749, 'ten_the_loai' => 'Phim Lãng Mạn', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()],
            ['id' => 878, 'ten_the_loai' => 'Phim Khoa Học Viễn Tưởng', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()],
            ['id' => 10770, 'ten_the_loai' => 'Chương Trình Truyền Hình', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()],
            ['id' => 53, 'ten_the_loai' => 'Phim Gây Cấn', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()],
            ['id' => 10752, 'ten_the_loai' => 'Phim Chiến Tranh', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()],
            ['id' => 37, 'ten_the_loai' => 'Phim Miền Tây', 'thoi_diem_tao' => now(), 'thoi_diem_cap_nhat' => now()]
        ]);
    }
}
