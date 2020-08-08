<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/trang-chinh', function () {
    return view('nguoidung.page.trangChinhPage');
});

Route::get('/read', function () {
    echo Storage::disk('local')->get('movies.json');
});

Route::get('/test', function () {
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
//                'thoiLuongChieu' => $info->vote_average,
//                'quocGiaSanXuat' => count($info->production_countries) > 0 ? $info->production_countries[0]->name : null,
//                'nhaSanXuat' => count($info->production_companies) > 0 ? $info->production_companies[0]->name : null,
//                'daoDien' => count($directors) > 0 ? $directors[0]->name : null,
//                'dienVien' => join(', ', array_map(function ($item) {
//                    return $item->name;
//                }, $info->credits->cast)),
//                'ngayKhoiChieu' => $info->release_date,
//                'noiDungPhim' => $info->overview,
//                'anhBia' => 'https://image.tmdb.org/t/p/original' . $info->poster_path,
//                'anhPhongNen' => 'https://image.tmdb.org/t/p/original' . $info->backdrop_path,
//                'trailer' => count($trailers) > 0 ? 'https://www.youtube.com/watch?v=' . $trailers[0]->key : null
//            ];
//        }
//    }
//    Storage::disk('local')->put('movies.json', json_encode($movies));
    echo 'Hoàn tất';
});


