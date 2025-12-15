@extends('layouts.master')

@section('title', 'Atur Ulang Password')

@section('content')
{{-- 
    VIEW: FORM RESET PASSWORD
    Halaman ini muncul setelah pengguna mengklik link di email reset password.
    Form ini mengirimkan Token (hidden), Email, dan Password Baru ke server untuk diperbarui.
--}}
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            
            {{-- Header Kartu --}}
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 font-weight-bold">
                    <i class="fas fa-unlock-alt mr-2"></i>{{ __('Reset Password') }}
                </h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ $email ?? old('email') }}" 
                                   required autocomplete="email" autofocus
                                   placeholder="Alamat Email Anda">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- 2. Input Password Baru --}}
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password"
                                   placeholder="Password Baru (Min 8 Karakter)">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- 3. Konfirmasi Password Baru --}}
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" 
                                   class="form-control" name="password_confirmation" 
                                   required autocomplete="new-password"
                                   placeholder="Ulangi Password Baru">
                        </div>
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                <i class="fas fa-save mr-1"></i> {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection