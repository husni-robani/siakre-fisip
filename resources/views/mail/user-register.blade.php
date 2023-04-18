<x-mail::message>
# Halo, {{$user->name}}

Selamat datang di Sistem Akreditasi FISIP!

<x-mail::table>
    | Email | Password |
    | :--------------------: | :-----------: |
    | {{$user->email}} | {{$password}} |
</x-mail::table>

<x-mail::button :url="route('login')">
Login
</x-mail::button>

Anda sekarang dapat masuk ke Sistem Akreditasi FISIP, segera ganti password anda.<br>

Kami berharap Anda akan menikmati waktu Anda di sistem kami. Terimakasih.<br>

Salam Hangat,<br>
{{ config('app.name') }}
</x-mail::message>
