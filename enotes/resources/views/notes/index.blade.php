@extends('layouts.master')

@section('title', 'Daftar Catatan')

@section('content')

{{-- 1. HEADER MODERN (Search Bar & Judul) --}}
<div class="row mb-5 align-items-center">
    <div class="col-lg-5 mb-3 mb-lg-0">
        <h2 class="font-weight-bold text-white mb-0" style="letter-spacing: 1px;">
            <i class="fas fa-clipboard-check mr-2 text-primary"></i>Daftar Catatan
        </h2>
        <p class="text-muted small ml-5 mb-0">Kelola semua tugas dan idemu di sini.</p>
    </div>

    <div class="col-lg-7">
        <form action="{{ route('notes.index') }}" method="GET">
            <div class="input-group">
                {{-- Input Search Premium (Bisa diakses Siapa Saja) --}}
                <input type="text" name="search" class="form-control input-search-premium" 
                       placeholder="Cari judul catatan..." value="{{ $keyword ?? '' }}">
                
                <div class="input-group-append">
                    <button class="btn btn-search-premium" type="submit"><i class="fas fa-search"></i></button>
                </div>

                {{-- [PERUBAHAN] Tombol Tambah DITARUH DILUAR @AUTH AGAR TAMU BISA LIHAT --}}
                <div class="ml-3">
                    <a href="{{ route('notes.create') }}" class="btn btn-premium btn-gradient-success h-100 shadow-sm">
                        <i class="fas fa-plus"></i> <span class="d-none d-md-inline ml-2">Baru</span>
                    </a>
                </div>

                {{-- Tombol Hapus Semua (HANYA UNTUK MEMBER) --}}
                @auth
                    @if(empty($keyword))
                        <div class="ml-2">
                            <button type="button" class="btn btn-premium btn-gradient-danger h-100" 
                                    data-toggle="modal" data-target="#deleteAllModal"
                                    title="Hapus Semua">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    @endif
                @endauth

            </div>
        </form>
        <form id="clear-all-form" action="{{ route('notes.clear') }}" method="POST" style="display: none;">@csrf @method('DELETE')</form>
    </div>
</div>

@if(session('alert'))
    <div class="alert alert-success border-0 shadow-sm" style="background: linear-gradient(to right, #28a745, #20c997); color: white;">
        <i class="fas fa-check-circle mr-2"></i> {{ session('alert') }}
    </div>
@endif

{{-- 2. DAFTAR NOTES (GRID) --}}
<div class="row">
    @forelse($ds as $note)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow border-0" style="border-radius: 15px; overflow: hidden;">
                
                {{-- Gambar --}}
                @if($note->image)
                    <div style="height: 180px; overflow: hidden;">
                        <img src="{{ asset('storage/' . $note->image) }}" class="w-100" style="object-fit: cover; height: 100%;">
                    </div>
                @else
                    <div style="height: 5px; background: linear-gradient(90deg, #007bff, #6610f2);"></div>
                @endif

                <div class="card-body d-flex flex-column">
                    <h5 class="font-weight-bold text-white mb-1">{{ $note->title }}</h5>
                    <small class="text-muted mb-3"><i class="fas fa-user mr-1"></i> {{ $note->author }}</small>
                    <p class="text-muted flex-grow-1">{{ Str::limit($note->content, 90) }}</p>
                    
                    {{-- LOGIKA TOMBOL AKSI --}}
                    @auth
                        {{-- JIKA MEMBER: Muncul tombol Edit & Hapus --}}
                        <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top border-secondary">
                            <div>
                                <a href="{{ route('notes.show', $note->id) }}" class="btn btn-premium btn-gradient-primary btn-sm mr-1"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-premium btn-gradient-warning btn-sm"><i class="fas fa-edit"></i></a>
                            </div>
                            <button type="button" class="btn btn-premium btn-gradient-danger btn-sm" 
                                    data-toggle="modal" data-target="#deleteModal" 
                                    data-action="{{ route('notes.destroy', $note->id) }}" 
                                    data-title="{{ $note->title }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    @else
                        {{-- JIKA TAMU: Hanya Muncul Tombol Baca --}}
                        <div class="mt-3 pt-3 border-top border-secondary text-right">
                            <a href="{{ route('notes.show', $note->id) }}" class="btn btn-premium btn-gradient-primary btn-sm btn-block">
                                <i class="fas fa-eye mr-2"></i>Baca Selengkapnya
                            </a>
                        </div>
                    @endauth

                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <h3 class="text-muted"><i class="far fa-folder-open fa-2x mb-3 d-block"></i>Belum ada catatan.</h3>
        </div>
    @endforelse

    {{-- MODALS HANYA DIRENDER JIKA LOGIN --}}
    @auth
        <div class="modal fade" id="deleteAllModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background-color: #1e1e1e; border: 1px solid #ff4444; color: white;">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title text-danger font-weight-bold">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Hapus Semua Catatan
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body text-center py-4">
                        <p class="mb-1">Apakah Anda yakin ingin menghapus <strong>SEMUA</strong> catatan?</p>
                        <small class="text-muted">Tindakan ini tidak dapat dibatalkan.</small>
                    </div>
                    <div class="modal-footer border-top-0 justify-content-center">
                        <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">Batal</button>
                        <form action="{{ route('notes.clear') }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger rounded-pill px-4 font-weight-bold">
                                Ya, Hapus Semuanya
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background-color: #1e1e1e; border: 1px solid #333; color: white;">
                    <div class="modal-header border-bottom-0"><h5 class="modal-title">Konfirmasi Hapus</h5><button type="button" class="close text-white" data-dismiss="modal">&times;</button></div>
                    <div class="modal-body text-center">Hapus catatan: <strong id="modalNoteTitle" class="text-primary"></strong>?</div>
                    <div class="modal-footer border-top-0 justify-content-center">
                        <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">Batal</button>
                        <form id="deleteForm" action="" method="POST">@csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger rounded-pill px-4">Ya, Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth
</div>

@auth
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            $(this).find('#deleteForm').attr('action', button.data('action'));
            $(this).find('#modalNoteTitle').text(button.data('title'));
        });
    });
</script>
@endauth

@endsection