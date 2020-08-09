<?php

use Illuminate\Database\Seeder;

class PhimSeeder extends Seeder
{

    public function run()
    {
        $movies = array_map(function ($item) {
            return [
                'EXTERNAL_ID' => $item->externalId,
                'THE_LOAI_EXTERNAL_ID' => json_encode($item->theLoaiExternalId),
                'TIEU_DE_GOC' => $item->tieuDeGoc ?? '--',
                'TIEU_DE_VI' => $item->tenPhim ?? '--',
                'DIEM_DANH_GIA' => $item->diemDanhGia ?? 0,
                'THOI_LUONG_CHIEU' => $item->thoiLuongChieu ?? 0,
                'QUOC_GIA_SAN_XUAT' => $item->quocGiaSanXuat,
                'NHA_SAN_XUAT' => $item->nhaSanXuat,
                'DAO_DIEN' => $item->daoDien,
                'DIEN_VIEN' => $item->dienVien,
                'NGAY_PHAT_HANH' => $item->ngayPhatHanh ?? '1900-01-01',
                'NOI_DUNG_TOM_TAT' => $item->noiDungPhim,
                'URL_ANH_BIA' => $item->anhBia,
                'URL_ANH_PHONG_NEN' => $item->anhPhongNen,
                'URL_TRAILER_VIDEO' => $item->trailer,
                'THOI_DIEM_TAO' => now(),
                'THOI_DIEM_CAP_NHAT' => now()
                'TRANG_THAI' => 'DANG_CHIEU'
            ];
        }, json_decode(Storage::disk('local')->get('movies.json')));
        DB::delete('delete from phim');
        foreach ($movies as $movie) {
            DB::table('phim')->insert($movie);
        }
    }
}
