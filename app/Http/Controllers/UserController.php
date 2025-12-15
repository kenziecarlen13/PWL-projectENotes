<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // READ DATA (Menampilkan Daftar User)
    public function index()
    {
        // Ambil semua data user, kecuali diri sendiri (opsional)
        $users = User::orderBy('id', 'desc')->get();

        // Gaya Dosen: Passing data pakai array 'ds'
        return view('users.index', [
            'key' => 'users',
            'ds' => $users
        ]);
    }

    // DELETE DATA (Hapus User)
    public function destroy($id)
    {
        // Cari user berdasarkan ID
        $user = User::find($id);

        // Cegah menghapus diri sendiri
        if ($user->id == Auth::id()) {
            return redirect("/users")->with('alert', 'Anda tidak bisa menghapus akun sendiri di sini!');
        }

        if ($user) {
            $user->delete(); // Hapus data
            // Jika ada gambar profil fisik, hapus juga di sini (opsional untuk user)
        }

        return redirect("/users")->with('alert', 'Data User Berhasil Di Hapus');
    }
}