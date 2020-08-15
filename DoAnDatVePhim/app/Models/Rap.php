<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rap extends Model
{
    protected $table = 'rap';
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


    public function danhSachPhongChieu()
    {
        return $this->hasMany(PhongChieu::class, 'rap_id', 'id');
    }

    public function danhSachGhe()
    {
        return $this->hasManyThrough(Ghe::class, PhongChieu::class, 'rap_id', 'phong_chieu_id', 'id', 'id');
    }

    public function danhSachSuatChieu() {
        return $this->hasManyThrough(SuatChieu::class, PhongChieu::class, 'rap_id', 'phong_chieu_id', 'id', 'id');
}
}
