<?php


namespace App\Repositories;


use App\Models\TheLoai;
use Illuminate\Database\Eloquent\Collection;

class TheLoaiRepository implements ITheLoaiRepository
{

    public function danhSach(): Collection
    {
        return TheLoai::all();
    }

    public function chiTiet(int $id): TheLoai
    {
        return TheLoai::findOrFail($id);
    }
}
