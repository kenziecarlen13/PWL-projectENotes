@extends('layouts.master')

@section('title', 'Ubah Password')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow" style="background-color: #1e1e1e; border: 1px solid #333;">
            <div class="card-header text-white" style="background-color: #6f42c1; border-bottom: 1px solid #333;">
                <h4 class="mb-0 font-weight-bold"><i class="fas fa-key mr-2"></i>Ubah Password</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('password.change.update') }}">
                    @csrf

                    {{-- Password Lama --}}
                    <div class="form-group">
                        <label class="text-white font-weight-bold">Password Lama</label>
                        <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" 
                               style="background-color: #2b2b2b; color: #fff; border: 1px solid #444;" required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr style="background-color: #444;">

                    {{-- Password Baru --}}
                    <div class="form-group">
                        <label class="text-white font-weight-bold">Password Baru (Min. 8 Karakter)</label>
                        <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" 
                               style="background-color: #2b2b2b; color: #fff; border: 1px solid #444;" required>
                        @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password Baru --}}
                    <div class="form-group">
                        <label class="text-white font-weight-bold">Ulangi Password Baru</label>
                        <input type="password" name="new_password_confirmation" class="form-control" 
                               style="background-color: #2b2b2b; color: #fff; border: 1px solid #444;" required>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('notes.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">Simpan Password Baru</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection