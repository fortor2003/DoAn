<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class XacThucUrl extends Model
{
    protected $table = 'xac_thuc_url';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    const CREATED_AT = 'thoi_diem_tao';
    const UPDATED_AT = 'thoi_diem_cap_nhat';
    protected $casts = [
        'thoi_diem_tao' => 'datetime:Y-m-d H:i:s',
        'thoi_diem_cap_nhat' => 'datetime:Y-m-d H:i:s'
    ];
    protected $fillable = ['loai', 'signature'];
    protected $hidden = [];

    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'tai_khoan_id', 'id');
    }
}
