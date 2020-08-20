<?php

namespace App\Models;

use App\Notifications\khachHang\KichHoatTaiKhoanNotification;
use App\Notifications\khachHang\TaoLaiMatKhauNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TaiKhoan extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;

    protected $table = 'tai_khoan';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    const CREATED_AT = 'thoi_diem_tao';
    const UPDATED_AT = 'thoi_diem_cap_nhat';
    protected $fillable = [
        'ho_ten', 'email', 'mat_khau', 'loai_vai_tro'
    ];
    protected $hidden = [
        'mat_khau', 'remember_token',
    ];
    protected $casts = [
        'thoi_diem_kich_hoat' => 'datetime',
        'thoi_diem_tao' => 'datetime:Y-m-d H:i:s',
        'thoi_diem_cap_nhat' => 'datetime:Y-m-d H:i:s'
    ];
    public function hasVerifiedEmail()
    {
        return $this->thoi_diem_kich_hoat !== null;
    }

    public function markEmailAsVerified()
    {
        $this->thoi_diem_kich_hoat = now();
        $this->save();
    }

    public function sendEmailVerificationNotification()
    {
        if (!$this->hasVerifiedEmail()) {
            $this->notify(new KichHoatTaiKhoanNotification());
        }
    }

    public function sendEmailResetPasswordNotification()
    {
        $this->notify(new TaoLaiMatKhauNotification());
    }

    public function getAuthPassword()
    {
        return $this->mat_khau;
    }

    /* Quan hệ */
    public function danhSachXacThucUrl() {
        return $this->hasMany(XacThucUrl::class, 'tai_khoan_id', 'id');
    }
}
