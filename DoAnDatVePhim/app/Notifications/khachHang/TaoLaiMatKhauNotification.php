<?php

namespace App\Notifications\khachHang;

use App\Mail\khachHang\TaoLaiMatKhauMail;
use App\Utils\StringUtil;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class TaoLaiMatKhauNotification extends Notification implements ShouldQueue
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
            'khachHang.taoLaiMatKhauPage', now()->addMinutes(config('route.lifetime_signed_url')), ['tai_khoan' => $taiKhoanId]
        );
        $notifiable->danhSachXacThucUrl()->create(['loai' => 'RESET_PASSWORD', 'signature' => StringUtil::getParamValueOfQueryStringUrl($signedUrl, 'signature')]);
        return (new TaoLaiMatKhauMail($signedUrl))->to($notifiable->email);
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
