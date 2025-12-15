<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AccountController extends Controller
{
    // Fungsi Hapus Akun Sendiri
    public function delete()
    {
        // 1. Ambil user yang sedang login
        $user = User::find(Auth::id());

        // 2. Logout dulu biar aman
        Auth::logout();

        // 3. Hapus data user dari database
        if ($user) {
            $user->delete();
        }

        // 4. Redirect ke halaman depan dengan pesan
        return redirect('/login')->with('alert', 'Akun Anda berhasil dihapus permanen. Sampai jumpa!');
    }
}