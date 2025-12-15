@extends('layouts.master')

@section('title', 'Selamat Datang')

@section('content')
{{-- 
    LANDING PAGE
    Halaman ini berfungsi sebagai gerbang utama bagi pengguna yang belum login.
    Memberikan opsi untuk Login, Registrasi, atau mencoba aplikasi sebagai Tamu.
--}}
<div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 70vh;">
    
    {{-- 1. Logo Aplikasi --}}
    <div class="mb-4 text-center">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height: 120px; width: auto; opacity: 0.9;">
    </div>

    {{-- 2. Header & Deskripsi Singkat (Hero Section) --}}
    <h1 class="display-4 font-weight-bold text-white mb-2">E-Notes App</h1>
    <p class="lead text-muted mb-5 text-center" style="max-width: 600px;">
        Simpan ide, tugas kuliah, dan snippet kodinganmu dengan aman, cepat, dan rapi.
    </p>

    {{-- 3. Kartu Navigasi Utama --}}
    <div class="card p-4 shadow-lg text-center" style="background-color: #1e1e1e; border: 1px solid #333; min-width: 320px; border-radius: 20px;">
        <h5 class="text-white mb-4">Mulai Sekarang</h5>
        
        {{-- Opsi Autentikasi (Member) --}}
        <div class="d-grid gap-2">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg btn-block font-weight-bold mb-3 shadow-sm">
                <i class="fas fa-sign-in-alt mr-2"></i> Login Akun
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-block mb-3">
                <i class="fas fa-user-plus mr-2"></i> Daftar Baru
            </a>
        </div>

        {{-- Pemisah Bagian (Divider) --}}
        <div class="d-flex align-items-center my-3">
            <div style="flex: 1; height: 1px; background-color: #444;"></div>
            <span class="px-2 text-muted small">ATAU</span>
            <div style="flex: 1; height: 1px; background-color: #444;"></div>
        </div>

        {{-- Opsi Akses Tamu (Guest Mode) --}}
        {{-- Mengarahkan langsung ke index notes tanpa middleware auth --}}
        <a href="{{ route('notes.index') }}" class="btn btn-warning btn-block font-weight-bold shadow-sm" style="color: #5c4206;">
            <i class="fas fa-user-secret mr-2"></i> Coba Mode Tamu
        </a>
        <small class="text-muted mt-2 d-block" style="font-size: 0.7rem;">
            *Catatan tamu bersifat sementara di browser ini.
        </small>
    </div>

</div>
@endsection