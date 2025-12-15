@extends('layouts.master')

@section('title', 'Verifikasi Email')

@section('content')
{{-- 
    VIEW: EMAIL VERIFICATION PROMPT
    Halaman ini ditampilkan secara otomatis oleh Middleware 'verified' 
    jika pengguna mencoba mengakses halaman yang dilindungi sebelum memverifikasi email.
--}}
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            
            {{-- Header Kartu --}}
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 font-weight-bold">
                    <i class="fas fa-envelope-open-text mr-2"></i>{{ __('Verify Your Email Address') }}
                </h4>
            </div>

            <div class="card-body">
                {{-- Notifikasi Sukses (Jika tombol resend diklik) --}}
                @if (session('resent'))
                    <div class="alert alert-success shadow-sm" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                {{-- Instruksi Utama --}}
                <p class="card-text">
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                </p>

                <hr class="my-4" style="background-color: #444;">

                {{-- Form Kirim Ulang Link --}}
                <p class="mb-0">
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        {{-- Menggunakan text-warning agar link terlihat jelas di background gelap --}}
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline font-weight-bold text-warning">
                            {{ __('click here to request another') }}
                        </button>.
                    </form>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection