@extends('layouts.master')

@section('title', 'Edit Catatan')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0" style="border-radius: 15px; background-color: #1e1e1e;">
            <div class="card-header bg-transparent border-bottom border-secondary text-white py-3">
                <h4 class="mb-0 font-weight-bold"><i class="fas fa-edit mr-2 text-warning"></i>Edit Catatan</h4>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('notes.update', $note->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 

                    {{-- Judul --}}
                    <div class="form-group">
                        <label class="font-weight-bold text-white">Judul Catatan</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $note->title) }}" required 
                               style="background-color: #2b2b2b; color: #fff; border: 1px solid #444; height: 50px;">
                    </div>

                    {{-- Gambar --}}
                    <div class="form-group">
                        <label class="font-weight-bold text-white">Gambar</label>
                        <div class="mb-3 p-2 border rounded" style="border-color: #444 !important; background: #2b2b2b;">
                            @if($note->image)
                                <img id="imagePreviewEdit" src="{{ asset('storage/' . $note->image) }}" class="img-fluid rounded" style="max-height: 200px;">
                            @else
                                <img id="imagePreviewEdit" src="#" class="img-fluid rounded" style="max-height: 200px; display: none;">
                            @endif
                        </div>
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="fileInputEdit">
                            <label class="custom-file-label" for="fileInputEdit" style="background-color: #2b2b2b; color: #aaa; border: 1px solid #444;">Ganti gambar...</label>
                        </div>
                    </div>

                    {{-- Penulis (Read Only) --}}
                    <div class="form-group">
                        <label class="font-weight-bold text-white">Penulis</label>
                        <input type="text" class="form-control" value="{{ $note->author }}" readonly 
                               style="background-color: #1a1a1a; color: #888; border: 1px solid #333;">
                    </div>

                    {{-- Isi --}}
                    <div class="form-group">
                        <label class="font-weight-bold text-white">Isi Catatan</label>
                        <textarea name="content" rows="8" class="form-control" required 
                                  style="background-color: #2b2b2b; color: #fff; border: 1px solid #444;">{{ old('content', $note->content) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('notes.index') }}" class="btn btn-premium btn-gradient-secondary px-4">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-premium btn-gradient-primary px-4">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection