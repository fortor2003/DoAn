<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ghe extends Model
{
    protected $table = 'ghe';
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


    public function phongChieu(){
        return $this->belongsTo(PhongChieu::class, 'phong_chieu_id', 'id');
    }
}
