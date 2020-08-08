<?php


namespace App\Repositories;


use App\Models\TheLoai;
use Illuminate\Database\Eloquent\Collection;

interface ITheLoaiRepository
{
    public function danhSach(): Collection;
    public function chiTiet(int $id): TheLoai;
}
