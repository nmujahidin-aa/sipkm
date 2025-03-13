@extends('mail.layouts.default')
@section('title', $title)
@section('content')
    <p style="margin: 0; margin-bottom: 16px;">Halo, {{ $user->name ?: 'Pejuang PIMNAS' }},</p>
    <p style="margin: 0; margin-bottom: 16px;">Anda baru saja melakukan permintaan untuk mengatur ulang kata sandi akun Website PKM Universitas Negeri Malang (UM) Anda.</p>
    <p style="margin: 0;">Untuk mengatur ulang kata sandi Anda, silakan klik tombol di bawah ini:</p>
@endsection

@section('content_footer')
    <p style="margin: 0; margin-bottom: 16px;">Jika tombol di atas tidak berfungsi, silakan klik tautan berikut ini atau salin dan tempelkan ke browser Anda:</p>
    <p style="margin: 0; margin-bottom: 16px;">{{ route('auth.reset-password.reset-page', ['token' => $token]) }}</p>
@endsection

@section('button')
    Atur Ulang Kata Sandi
@endsection

@section('button_url')
    {{ route('auth.reset-password.reset-page', ['token' => $token]) }}
@endsection
