<?php

use Illuminate\Support\Facades\Route;

Route::get('/read', function () {
    $movies = json_decode(Storage::disk('local')->get('movies.json'));
//    dump($movies);
    dump(array_map(function ($item) {
        return [
            'EXTERNAL_ID' => $item->externalId,
            'THE_LOAI_EXTERNAL_ID' => json_encode($item->theLoaiExternalId),
            'TIEU_DE_GOC' => $item->tieuDeGoc,
            'TIEU_DE_VI' => $item->tenPhim,
            'DIEM_DANH_GIA' => $item->diemDanhGia,
            'THOI_LUONG_CHIEU' => $item->thoiLuongChieu,
            'QUOC_GIA_SAN_XUAT' => $item->quocGiaSanXuat,
            'NHA_SAN_XUAT' => $item->nhaSanXuat,
            'DAO_DIEN' => $item->daoDien,
            'DIEN_VIEN' => $item->dienVien,
            'NGAY_PHAT_HANH' => $item->ngayPhatHanh,
            'NGAY_KHOI_CHIEU' => null,
            'NGAY_KET_THUC' => null,
            'NOI_DUNG_TOM_TAT' => $item->noiDungPhim,
            'URL_ANH_BIA' => $item->anhBia,
            'URL_ANH_PHONG_NEN' => $item->anhPhongNen,
            'URL_TRAILER_VIDEO' => $item->trailer,
            'THOI_DIEM_TAO' => now(),
            'THOI_DIEM_CAP_NHAT' => now()
        ];
    }, array_slice($movies, 0, 30)));
});

Route::get('/movies', function () {
    /** Danh sách thể loại */
//    $response = Http::get('https://api.themoviedb.org/3/genre/movie/list', [
//        'language' => 'vi-VN',
//        'api_key' => '78020666840c428e02c7170e57e15bda',
//    ]);
//    $list = json_decode($response->getBody()->getContents())->genres;
//    $genres = [];
//    foreach ($list as $item) {
//        $genres[] = [
//            'externalId' => $item->id,
//            'tenTheLoai' => $item->name
//        ];
//    }
//    Storage::disk('local')->put('genres.json', json_encode($genres));

//    set_time_limit(8000000);
//    $movies = [];
//    for ($i = 1; $i <= 36; $i++) {
//        $response = Http::get('https://api.themoviedb.org/3/discover/movie?', [
//            'api_key' => '78020666840c428e02c7170e57e15bda',
//            'language' => 'vi-VN',
//            'with_release_type' => '2|3',
//            'region' => 'VN',
//            'sort_by' => 'release_date.asc',
//            'page' => $i
//        ]);
//        $list = json_decode($response->getBody()->getContents())->results;
//        foreach ($list as $item) {
//            $responseDetail = Http::get("https://api.themoviedb.org/3/movie/$item->id", [
//                'language' => 'vi-VN',
//                'append_to_response' => 'credits',
//                'api_key' => '78020666840c428e02c7170e57e15bda',
//            ]);
//            $responseMovies = Http::get("https://api.themoviedb.org/3/movie/$item->id/videos", [
//                'api_key' => '78020666840c428e02c7170e57e15bda'
//            ]);
//            $info = json_decode($responseDetail->getBody()->getContents());
//            $videos = json_decode($responseMovies->getBody()->getContents())->results;
//            $trailers = array_values(array_filter($videos, function ($item) {
//                return $item->type === 'Trailer';
//            }));
//            $directors = array_values(array_filter($info->credits->crew, function ($item) {
//                return $item->job === 'Director';
//            }));
//            $movies[] = [
//                'externalId' => $info->id,
//                'tieuDeGoc' => $info->original_title,
//                'tenPhim' => $info->title,
//                'theLoaiExternalId' => array_map(function ($item) {
//                    return $item->id;
//                }, $info->genres),
//                'diemDanhGia' => $info->vote_average,
//                'thoiLuongChieu' => $info->runtime,
//                'quocGiaSanXuat' => count($info->production_countries) > 0 ? $info->production_countries[0]->name : null,
//                'nhaSanXuat' => count($info->production_companies) > 0 ? $info->production_companies[0]->name : null,
//                'daoDien' => count($directors) > 0 ? $directors[0]->name : null,
//                'dienVien' => join(', ', array_map(function ($item) {
//                    return $item->name;
//                }, $info->credits->cast)),
//                'ngayPhatHanh' => $info->release_date,
//                'noiDungPhim' => $info->overview,
//                'anhBia' => 'https://image.tmdb.org/t/p/original' . $info->poster_path,
//                'anhPhongNen' => 'https://image.tmdb.org/t/p/original' . $info->backdrop_path,
//                'trailer' => count($trailers) > 0 ? 'https://www.youtube.com/watch?v=' . $trailers[0]->key : null
//            ];
//        }
//    }
//    Storage::disk('local')->put('movies.json', json_encode($movies));
//    echo 'Hoàn tất';
});


