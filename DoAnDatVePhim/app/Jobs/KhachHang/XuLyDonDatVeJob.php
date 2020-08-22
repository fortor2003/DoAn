<?php

namespace App\Jobs\KhachHang;

use App\Models\DonDatVe;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class XuLyDonDatVeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $donDatVeId;

    public function __construct($donDatVeId)
    {
        $this->donDatVeId = $donDatVeId;
    }

    public function handle()
    {
        $donDatVe = DonDatVe::find($this->donDatVeId);
        if ($donDatVe && $donDatVe->tinh_trang == 'CHUA_THANH_TOAN') {
            DB::transaction(function () use ($donDatVe) {
                $donDatVe->danhSachVe()->delete();
                $donDatVe->delete();
            });
        }
    }
}
