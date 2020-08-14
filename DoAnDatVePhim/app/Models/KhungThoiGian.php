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


//    public function danhSachPhim()
//    {
//        return $this->belongsToMany(Phim::class, PhimTheLoai::class, 'the_loai_id', 'phim_id', 'id', 'id');
//    }
}