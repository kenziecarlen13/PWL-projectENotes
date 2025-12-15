@extends('layouts.master')

@section('title', 'Daftar Akun Baru')

@section('content')
{{-- 
    VIEW: REGISTER PAGE
    Halaman pendaftaran pengguna baru.
    Form ini mengirim data ke Route 'register' (POST) yang ditangani oleh RegisterController.
--}}
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            
            {{-- Header Kartu --}}
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 font-weight-bold">
                    <i class="fas fa-user-plus mr-2"></i>{{ __('Register') }}
                </h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- 1. Input Nama --}}
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" 
                                   required autocomplete="name" autofocus
                                   placeholder="Nama Lengkap">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- 2. Input Email --}}
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" 
                                   required autocomplete="email"
                                   placeholder="contoh@email.com">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- 3. Input Password --}}
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password"
                                   placeholder="Minimal 8 karakter">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- 4. Konfirmasi Password --}}
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" 
                                   class="form-control" name="password_confirmation" 
                                   required autocomplete="new-password"
                                   placeholder="Ulangi password di atas">
                        </div>
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                <i class="fas fa-user-plus mr-1"></i> {{ __('Register') }}
                            </button>
                            
                            <a class="btn btn-link text-muted ml-2" href="{{ route('login') }}">
                                Sudah punya akun?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection