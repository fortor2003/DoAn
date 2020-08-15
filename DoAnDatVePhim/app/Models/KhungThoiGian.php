<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhungThoiGian extends Model
{
    protected $table = 'khung_thoi_gian';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    const CREATED_AT = 'thoi_diem_tao';
    const UPDATED_AT = 'thoi_diem_cap_nhat';
    protected $casts = [
        'thoi_diem_tao' => 'datetime:Y-m-d H:i:s',
        'thoi_diem_cap_nhat' => 'datetime:Y-m-d H:i:s'
    ];
    protected $hidden = [];

    public function danhSachSuatChieu_gioBatDau() {
        return $this->hasMany(SuatChieu::class, 'gio_bat_dau_slot', 'slot');
    }

    public function danhSachSuatChieu_gioKetThuc() {
        return $this->hasMany(SuatChieu::class, 'gio_ket_thuc_slot', 'slot');
    }
}
