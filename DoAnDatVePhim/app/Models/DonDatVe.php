<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonDatVe extends Model
{
    protected $table = 'don_dat_ve';
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
    protected $fillable = ['ma_don', 'suat_chieu_id', 'khach_hang_id', 'nhan_vien_id', 'tinh_trang', 'thoi_diem_thanh_toan'];

    public function suatChieu()
    {
        return $this->belongsTo(SuatChieu::class, 'suat_chieu_id', 'id');
    }

    public function danhSachVe()
    {
        return $this->hasMany(Ve::class, 'don_dat_ve_id', 'id');
    }
}
