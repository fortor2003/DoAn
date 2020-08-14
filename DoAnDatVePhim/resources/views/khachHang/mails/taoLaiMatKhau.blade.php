@component('mail::message')

Thư kích tạo lại mật khẩu của bạn !

@component('mail::button', ['url' => $url])
    Tạo lại mật khẩu
@endcomponent

Cảm ơn,<br>
{{ config('app.name') }}
@endcomponent
