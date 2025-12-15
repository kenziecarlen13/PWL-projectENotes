@extends('layouts.master')

@section('title', 'Buat Catatan Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        {{-- Card Container --}}
        <div class="card shadow" style="background-color: #1e1e1e; border: 1px solid #333;">
            <div class="card-header text-white" style="background-color: #28a745; border-bottom: 1px solid #333;">
                <h4 class="mb-0 font-weight-bold"><i class="fas fa-plus mr-2"></i>Tulis Catatan Baru</h4>
            </div>

            <div class="card-body">
                {{-- Form Create --}}
                <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf 

                    {{-- 1. Input Judul --}}
                    <div class="form-group">
                        <label for="title" class="font-weight-bold text-white">Judul Catatan</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title') }}" placeholder="Contoh: Jadwal Kuliah" required
                               style="background-color: #2b2b2b; color: #fff; border: 1px solid #444;">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 2. Input Gambar (Dengan Preview) --}}
                    <div class="form-group">
                        <label class="font-weight-bold text-white">Upload Gambar</label>
                        
                        {{-- Area Preview --}}
                        <div class="mb-2">
                            <img id="imagePreviewCreate" src="#" alt="Preview Gambar" class="img-thumbnail" 
                                 style="max-height: 200px; display: none; background-color: #2b2b2b; border: 1px solid #444;">
                        </div>

                        {{-- Custom File Input Bootstrap --}}
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror" id="fileInput">
                                <label class="custom-file-label" for="fileInput" style="background-color: #2b2b2b; color: #aaa; border: 1px solid #444;">
                                    Pilih file gambar...
                                </label>
                            </div>
                        </div>
                        <small class="text-muted mt-2 d-block">Format: JPG, JPEG, PNG. Maks: 2MB.</small>
                        
                        @error('file')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 3. Input Isi --}}
                    <div class="form-group">
                        <label for="content" class="font-weight-bold text-white">Isi Catatan</label>
                        <textarea name="content" id="content" rows="8" class="form-control @error('content') is-invalid @enderror" 
                                  placeholder="Tulis detail catatan..." required
                                  style="background-color: #2b2b2b; color: #fff; border: 1px solid #444;">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('notes.index') }}" class="btn btn-secondary px-4">
                            <i class="fas fa-times mr-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection