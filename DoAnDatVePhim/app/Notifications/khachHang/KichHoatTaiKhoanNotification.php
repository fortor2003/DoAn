<?php

namespace App\Notifications\khachHang;

use App\Mail\khachHang\KichHoatTaiKhoanMail;
use App\Utils\StringUtil;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Contracts\Queue\ShouldQueue;

class KichHoatTaiKhoanNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $taiKhoanId = $notifiable->id;
        $signedUrl = URL::temporarySignedRoute(
            'khachHang.kichHoatTaiKhoan', now()->addMinutes(config('route.lifetime_signed_url')), ['tai_khoan' => $taiKhoanId]
        );
        $notifiable->danhSachXacThucUrl()->create(['loai' => 'VERIFY_EMAIL', 'signature' => StringUtil::getParamValueOfQueryStringUrl($signedUrl, 'signature')]);
        return (new KichHoatTaiKhoanMail($signedUrl))->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
