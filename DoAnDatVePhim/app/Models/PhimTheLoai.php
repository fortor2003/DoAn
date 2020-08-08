<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhimTheLoai extends Model
{
    protected $table = 'phim_the_loai';
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

    public function phim() {
        return $this->belongsTo(Phim::class, 'phim_id', 'id');
    }

    public function theLoai() {
        return $this->belongsTo(TheLoai::class, 'the_loai_id', 'id');
    }
}
