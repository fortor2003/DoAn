<?php

namespace App\Events\khachHang;

use App\Services\khachHang\GheService;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaoDonDatVeEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $suatChieuId;
    private $gheService;

    public function __construct($suatChieuId)
    {
        $this->suatChieuId = $suatChieuId;
        $this->gheService = app(GheService::class);
    }

    public function broadcastOn()
    {
        return new PrivateChannel('KhachHang.DatVe.' . $this->suatChieuId);
    }

    public function broadcastAs()
    {
        return 'TaoDonDatVeEvent';
    }

    public function broadcastWith()
    {
        return $this->gheService->danhSachGheTheoTinhTrang($this->suatChieuId);
    }
}
