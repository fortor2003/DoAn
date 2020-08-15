<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuatChieu extends Model
{
    protected $table = 'suat_chieu';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    const CREATED_AT = 'thoi_diem_tao';
    const UPDATED_AT = 'thoi_diem_cap_nhat';
    protected $casts = [
        'giao_ngay' => 'boolean',
        'thoi_diem_tao' => 'datetime:Y-m-d H:i:s',
        'thoi_diem_cap_nhat' => 'datetime:Y-m-d H:i:s'
    ];
    protected $hidden = ['laravel_through_key'];
    protected $fillable = ['phim_id', 'phong_chieu_id', 'ngay_chieu', 'gio_bat_dau_slot', 'gio_ket_thuc_slot', 'giao_ngay'];

    public function phim()
    {
        return $this->belongsTo(Phim::class, 'phim_id', 'id');
    }

    public function phongChieu()
    {
        return $this->belongsTo(PhongChieu::class, 'phong_chieu_id', 'id');
    }

    public function rap()
    {
        return $this->hasOneThrough(Rap::class, PhongChieu::class, 'id', 'id', 'phong_chieu_id', 'rap_id');
    }

    public function gioBatDau()
    {
        return $this->belongsTo(KhungThoiGian::class, 'gio_bat_dau_slot', 'slot');
    }

    public function gioKetThuc()
    {
        return $this->belongsTo(KhungThoiGian::class, 'gio_ket_thuc_slot', 'slot');
    }


}
