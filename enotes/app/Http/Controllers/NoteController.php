<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
{
    // 1. MENAMPILKAN DATA (User vs Tamu)
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        // LOGIKA PEMISAH DATA
        if (Auth::check()) {
            // Jika Member: Ambil berdasarkan user_id
            $query = Note::where('user_id', Auth::id());
        } else {
            // Jika Tamu: Ambil berdasarkan session_token browser ini
            $query = Note::where('session_token', session()->getId());
        }

        // LOGIKA SEARCH
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('content', 'like', "%{$keyword}%");
            });
        }

        // Urutkan dari yang terbaru
        $notes = $query->orderBy('created_at', 'desc')->get();

        return view('notes.index', [
            'ds' => $notes,
            'keyword' => $keyword
        ]);
    }

    // 2. FORM CREATE (Bisa diakses Tamu)
    public function create()
    {
        return view('notes.create');
    }

    // 3. SIMPAN DATA (User vs Tamu)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'file' => 'image|file|max:2048', 
        ]);

        // Upload Gambar
        $imagePath = null;
        if ($request->file('file')) {
            $fileName = time() . '-' . $request->file('file')->getClientOriginalName();
            // Simpan ke 'storage/app/public/foto'
            $imagePath = $request->file('file')->storeAs('foto', $fileName, 'public');
        }

        // Siapkan Data Dasar
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ];

        // Tentukan Pemilik Data
        if (Auth::check()) {
            // JIKA MEMBER
            $data['author'] = Auth::user()->name;
            $data['user_id'] = Auth::id();
            $data['session_token'] = null; // Member tidak butuh session token
        } else {
            // JIKA TAMU
            $data['author'] = 'Guest User';
            $data['user_id'] = null;
            $data['session_token'] = session()->getId(); // KUNCI: Simpan ID Session Browser
        }

        // Simpan ke Database
        Note::create($data);

        return redirect("/notes")->with('alert', 'Catatan Berhasil Disimpan!');
    }

    // 4. SHOW DETAIL (Tamu boleh lihat punya sendiri)
    public function show(Note $note)
    {
        $this->authorizeAccess($note);
        return view('notes.show', compact('note'));
    }

    // 5. EDIT FORM (Hanya Member - Sesuai Route)
    public function edit(Note $note)
    {
        $this->authorizeAccess($note); // Proteksi extra
        return view('notes.edit', compact('note'));
    }

    // 6. UPDATE (Hanya Member)
    public function update(Request $request, Note $note)
    {
        $this->authorizeAccess($note);

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'file' => 'image|file|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
        ];

        // Ganti Gambar
        if ($request->file('file')) {
            if ($note->image) {
                Storage::disk('public')->delete($note->image);
            }
            $fileName = time() . '-' . $request->file('file')->getClientOriginalName();
            $data['image'] = $request->file('file')->storeAs('foto', $fileName, 'public');
        }

        $note->update($data);

        return redirect("/notes")->with('alert', 'Catatan Berhasil Diubah!');
    }

    // 7. DELETE (Hanya Member)
    public function destroy(Note $note)
    {
        $this->authorizeAccess($note);

        if ($note->image) {
            Storage::disk('public')->delete($note->image);
        }

        $note->delete();

        return redirect("/notes")->with('alert', 'Catatan Berhasil Dihapus!');
    }

    // 8. HAPUS SEMUA (User hapus miliknya, Tamu hapus sesi dia)
    public function clearAll()
    {
        if (Auth::check()) {
            // Hapus milik User
            $notes = Note::where('user_id', Auth::id())->get();
        } else {
            // Hapus milik Tamu (Session ini)
            // *Opsi Tambahan: Jika tamu boleh hapus semua catatannya sendiri
            $notes = Note::where('session_token', session()->getId())->get();
        }

        // Hapus gambar fisiknya dulu (Looping)
        foreach ($notes as $note) {
            if ($note->image) {
                Storage::disk('public')->delete($note->image);
            }
            $note->delete();
        }

        return redirect("/notes")->with('alert', 'Semua Catatan Berhasil Dihapus!');
    }

    // FUNGSI KEAMANAN: Cek Kepemilikan Data
    private function authorizeAccess($note)
    {
        if (Auth::check()) {
            // Member tidak boleh akses data Member lain ATAU data Tamu
            if ($note->user_id !== Auth::id()) {
                abort(403, 'Akses Ditolak: Ini bukan catatan Anda.');
            }
        } else {
            // Tamu tidak boleh akses data Member ATAU data Tamu lain
            if ($note->session_token !== session()->getId()) {
                abort(403, 'Akses Ditolak: Sesi Anda berbeda.');
            }
        }
    }
}