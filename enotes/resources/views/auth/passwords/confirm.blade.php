@extends('layouts.master')

@section('title', 'Konfirmasi Password')

@section('content')
{{-- 
    VIEW: PASSWORD CONFIRMATION
    Halaman ini muncul OTOMATIS jika User mengakses route yang dilindungi middleware 'password.confirm'.
    Ini adalah lapisan keamanan tambahan untuk aksi sensitif (misal: ubah setting billing atau hapus data penting).
--}}
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            
            {{-- Header Kartu --}}
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 font-weight-bold">
                    <i class="fas fa-user-lock mr-2"></i>{{ __('Confirm Password') }}
                </h4>
            </div>

            <div class="card-body">
                {{-- Instruksi --}}
                <div class="alert alert-info shadow-sm mb-4">
                    <i class="fas fa-info-circle mr-1"></i>
                    {{ __('Please confirm your password before continuing.') }}
                </div>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    {{-- Input Password --}}
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="current-password"
                                   placeholder="Masukkan password Anda saat ini"
                                   autofocus>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                <i class="fas fa-check-double mr-1"></i> {{ __('Confirm Password') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-muted" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection