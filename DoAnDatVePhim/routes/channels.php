<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/
Broadcast::routes(['middleware' => ['auth:sanctum']]);

Broadcast::channel('App.TaiKhoan.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('KhachHang.DatVe.{suatChieuId}', function ($user, $suatChieuId) {
    $suatChieu = \App\Models\SuatChieu::find($suatChieuId);
    return $suatChieu;
});

//Broadcast::channel('task.created', function ($user, $id) {
//    return true;
//});
