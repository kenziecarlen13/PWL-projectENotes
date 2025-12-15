@extends('layouts.master')

@section('title', $note->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        
        {{-- CARD UTAMA DENGAN STYLE MODERN --}}
        <div class="card shadow-lg border-0 overflow-hidden" style="background-color: #1e1e1e; border-radius: 15px;">
            
            {{-- BAGIAN 1: HEADER GAMBAR / GRADIENT --}}
            @if($note->image)
                {{-- Jika ada gambar, tampilkan full width dengan efek shadow halus --}}
                <div class="position-relative" style="background-color: #000;">
                    <img src="{{ asset('storage/' . $note->image) }}" 
                         alt="{{ $note->title }}" 
                         class="w-100" 
                         style="max-height: 500px; object-fit: contain; mask-image: linear-gradient(to bottom, black 80%, transparent 100%);">
                    
                    {{-- Tombol Kembali (Overlay di atas gambar) --}}
                    <a href="{{ route('notes.index') }}" class="btn btn-dark btn-sm rounded-pill position-absolute" style="top: 20px; left: 20px; opacity: 0.8;">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            @else
                {{-- Jika TIDAK ada gambar, tampilkan Header Gradient Keren --}}
                <div class="p-5 position-relative" style="background: linear-gradient(135deg, #007bff, #6610f2);">
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('https://www.transparenttextures.com/patterns/cubes.png'); opacity: 0.2;"></div>
                    
                    {{-- Tombol Kembali --}}
                    <a href="{{ route('notes.index') }}" class="btn btn-light btn-sm rounded-pill position-absolute shadow-sm" style="top: 20px; left: 20px; color: #007bff; font-weight: bold;">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>

                    <div class="text-center text-white mt-3">
                        <i class="far fa-file-alt fa-4x mb-3" style="opacity: 0.5;"></i>
                    </div>
                </div>
            @endif

            {{-- BAGIAN 2: KONTEN UTAMA --}}
            <div class="card-body p-4 p-md-5" style="position: relative; z-index: 10;">
                
                {{-- Judul Besar --}}
                <h1 class="font-weight-bold text-white mb-3" style="font-size: 2.5rem; letter-spacing: -1px; line-height: 1.2;">
                    {{ $note->title }}
                </h1>

                {{-- Meta Data (Penulis & Waktu) --}}
                <div class="d-flex align-items-center mb-4 pb-3" style="border-bottom: 1px solid #333;">
                    <div class="mr-4 text-muted">
                        <i class="fas fa-user-circle mr-2 text-primary"></i>
                        <span class="text-light font-weight-bold">{{ $note->author }}</span>
                    </div>
                    <div class="text-muted">
                        <i class="far fa-clock mr-2 text-success"></i>
                        <span style="font-family: monospace;">{{ $note->created_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>

                {{-- Isi Konten --}}
                <div class="content-area text-light" style="font-size: 1.15rem; line-height: 1.8; white-space: pre-wrap; font-weight: 300;">
                    {!! nl2br(e($note->content)) !!}
                </div>

            </div>

            {{-- BAGIAN 3: FOOTER AKSI --}}
            <div class="card-footer bg-dark border-top border-secondary p-4 d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Terakhir diubah: {{ $note->updated_at->diffForHumans() }}
                </small>
                
                <div>
                    {{-- Tombol Edit --}}
                    <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-warning rounded-pill px-4 font-weight-bold shadow-sm hover-lift">
                        <i class="fas fa-edit mr-2"></i> Edit Catatan
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- CSS Tambahan Khusus Halaman Ini --}}
<style>
    .hover-lift {
        transition: transform 0.2s;
    }
    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(255, 193, 7, 0.3) !important;
    }
</style>
@endsection