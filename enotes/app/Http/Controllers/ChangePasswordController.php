<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class ChangePasswordController extends Controller
{
    // 1. TAMPILKAN FORM
    public function index()
    {
        return view('auth.passwords.change');
    }

    // 2. PROSES GANTI PASSWORD
    public function update(Request $request)
    {
        // A. Validasi Input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // 'confirmed' otomatis cek field new_password_confirmation
        ]);

        // B. Cek Password Lama Benar
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            // Jika salah, kembalikan dengan error
            return back()->withErrors(['current_password' => 'Password lama tidak cocok!']);
        }

        // C. Update Password Baru
        User::find(Auth::id())->update([
            'password' => Hash::make($request->new_password)
        ]);

        // D. Redirect ke Dashboard dengan Pesan Sukses
        return redirect()->route('notes.index')->with('alert', 'Password Berhasil Diubah! Silakan login ulang jika diperlukan.');
    }
}