@extends('layouts.master')

@section('title', 'Master Data User')

@section('content')

<div class="row">
    <div class="col-md-12">
        
        {{-- Judul Halaman --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-white font-weight-bold"><i class="fas fa-users mr-2"></i>Master Data User</h2>
        </div>

        {{-- Alert Notifikasi --}}
        @if(session('alert'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Info:</strong> {{ session('alert') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        {{-- Tabel Data --}}
        <div class="card shadow" style="background-color: #1e1e1e; border: 1px solid #333;">
            <div class="card-body">
                
                {{-- TABLE DENGAN ID "example" UNTUK DATATABLES --}}
                <div class="table-responsive">
                    <table id="example" class="table table-dark table-hover table-bordered" style="width:100%">
                        <thead class="bg-primary">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Pengguna</th>
                                <th>Email</th>
                                <th>Bergabung Sejak</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ds as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        {{-- Avatar Placeholder --}}
                                        <div class="rounded-circle bg-secondary mr-2 d-flex justify-content-center align-items-center" style="width: 35px; height: 35px;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <span class="font-weight-bold">{{ $user->name }}</span>
                                        
                                        @if($user->id == Auth::id())
                                            <span class="badge badge-success ml-2">Saya</span>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td class="text-center">
                                    {{-- Tombol Hapus (Kecuali Diri Sendiri) --}}
                                    @if($user->id != Auth::id())
                                        <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger btn-sm" 
                                           onclick="return confirm('Yakin ingin menghapus user ini? Catatan miliknya juga akan hilang.')">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </a>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled><i class="fas fa-lock"></i></button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- SCRIPT KHUSUS DATATABLES (SESUAI MODUL 11) --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json"
            }
        });
    });
</script>

@endsection