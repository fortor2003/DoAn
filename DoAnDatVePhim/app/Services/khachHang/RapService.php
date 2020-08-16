<?php

namespace App\Services\khachHang;

use App\Models\Rap;
use App\Utils\StringUtil;

class RapService
{

    /**
     * Trả về danh sách các rạp chiếu
     * @return array
     */
    public function danhSachRap(): array
    {
        return Rap::select(['id', 'ten_rap'])->get()->toArray();
    }
}
