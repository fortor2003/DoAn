@component('mail::message')

Thư kích hoạt tài khoản của bạn !

@component('mail::button', ['url' => $url])
    Kích hoạt
@endcomponent

Cảm ơn,<br>
{{ config('app.name') }}
@endcomponent
