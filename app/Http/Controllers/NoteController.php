<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 

class NoteController extends Controller
{
    // READ (Menampilkan Data)
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        if (Auth::check()) {
            $query = Auth::user()->notes();
        } else {
            $query = Note::where('session_token', session()->getId());
        }

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('content', 'like', "%{$keyword}%");
            });
        }

        $notes = $query->orderBy('updated_at', 'desc')->get();

        return view('notes.index', [
            'key' => 'notes',
            'ds' => $notes,
            'keyword' => $keyword
        ]);
    }

    public function create()
    {
        return view('notes.create');
    }

    // CREATE (Simpan Data + Gambar)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'file' => 'image|file|max:2048', 
        ]);

        // LOGIKA UPLOAD GAMBAR
        $imagePath = null;
        if ($request->file('file')) {
            $fileName = time() . '-' . $request->file('file')->getClientOriginalName();
            $imagePath = $request->file('file')->storeAs('foto', $fileName, 'public');
        }

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ];

        if (Auth::check()) {
            $data['author'] = Auth::user()->name;
            $request->user()->notes()->create($data);
        } else {
            $data['author'] = 'Guest User';
            $data['user_id'] = null;
            $data['session_token'] = session()->getId();
            Note::create($data);
        }

        return redirect("/notes")->with('alert', 'Data Berhasil Di Tambahkan');
    }

    public function show(Note $note)
    {
        $this->authorizeAccess($note);
        return view('notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        $this->authorizeAccess($note);
        return view('notes.edit', compact('note'));
    }

    // UPDATE (Edit Data + Ganti Gambar)
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

        // Cek jika ada upload gambar baru
        if ($request->file('file')) {
            // Hapus gambar lama jika ada
            if ($note->image) {
                Storage::disk('public')->delete($note->image);
            }

            // Simpan gambar baru
            $fileName = time() . '-' . $request->file('file')->getClientOriginalName();
            $data['image'] = $request->file('file')->storeAs('foto', $fileName, 'public');
        }

        $note->update($data);

        return redirect("/notes")->with('alert', 'Data Berhasil Di Ubah');
    }

    // DELETE (Hapus Data + Gambar)
    public function destroy(Note $note)
    {
        $this->authorizeAccess($note);

        // Hapus gambar fisik
        if ($note->image) {
            Storage::disk('public')->delete($note->image);
        }

        $note->delete();

        return redirect("/notes")->with('alert', 'Data Berhasil Di Hapus');
    }

    public function clearAll()
    {
        if (Auth::check()) {
            Auth::user()->notes()->delete();
        } else {
            Note::where('session_token', session()->getId())->delete();
        }
        return redirect("/notes")->with('alert', 'Semua Data Berhasil Di Hapus');
    }

    private function authorizeAccess($note)
    {
        if (Auth::check()) {
            if ($note->user_id !== Auth::id()) {
                abort(403, 'Akses Ditolak');
            }
        } else {
            if ($note->session_token !== session()->getId()) {
                abort(403, 'Akses Ditolak');
            }
        }
    }
}