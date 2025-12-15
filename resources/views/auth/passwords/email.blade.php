@extends('layouts.master')

@section('title', 'Lupa Password')

@section('content')
{{-- 
    VIEW: REQUEST RESET LINK
    Halaman ini adalah langkah pertama jika user lupa password.
    User menginput email, dan sistem mengirimkan link unik ke email tersebut.
--}}
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            
            {{-- Header Kartu --}}
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 font-weight-bold">
                    <i class="fas fa-key mr-2"></i>{{ __('Reset Password') }}
                </h4>
            </div>

            <div class="card-body">
                
                {{-- 
                    ALERT: SUKSES KIRIM EMAIL
                    Menampilkan notifikasi bahwa email telah dikirim.
                    Kita tambahkan pesan "Cek Spam" agar user tidak bingung.
                --}}
                @if (session('status'))
                    <div class="alert alert-success shadow-sm" role="alert">
                        <h5 class="alert-heading font-weight-bold">
                            <i class="fas fa-check-circle mr-2"></i>Email Terkirim!
                        </h5>
                        <p class="mb-0">{{ session('status') }}</p>
                        
                        <hr>
                        
                        <p class="mb-0 font-weight-bold" style="color: #155724;">
                            <i class="fas fa-exclamation-triangle mr-1"></i> 
                            Jika tidak ada di Inbox, MOHON CEK FOLDER SPAM / JUNK.
                        </p>
                    </div>
                @endif

                {{-- Form Request Link --}}
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" 
                                   required autocomplete="email" autofocus
                                   placeholder="Masukkan alamat email akun Anda">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                <i class="fas fa-paper-plane mr-1"></i> {{ __('Send Password Reset Link') }}
                            </button>
                            
                            <a class="btn btn-link text-muted ml-2" href="{{ route('login') }}">
                                Kembali ke Login
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection