<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ve extends Model
{
    protected $table = 've';
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
    protected $fillable = ['ma_ve', 'don_dat_ve_id', 'ghe_id'];

    public function donDatVe()
    {
        return $this->belongsTo(DonDatVe::class, 'don_dat_ve_id', 'id');
    }

}
