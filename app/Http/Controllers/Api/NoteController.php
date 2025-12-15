<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Note;
use App\Http\Resources\NoteResource;

class NoteController extends Controller
{
    /**
     * Menampilkan daftar seluruh catatan (GET All).
     * Endpoint ini mengembalikan data dalam format JSON yang dibungkus
     * oleh API Resource agar format datanya konsisten.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Mengambil data terbaru (ORDER BY created_at DESC)
        $notes = Note::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Notes',
            'data'    => NoteResource::collection($notes)
        ], 200);
    }

    /**
     * Menampilkan detail satu catatan spesifik berdasarkan ID (GET Detail).
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $note = Note::find($id);

        if ($note) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Note',
                'data'    => new NoteResource($note)
            ], 200);
        }

        // Jika data tidak ditemukan, kembalikan status 404 (Not Found)
        return response()->json([
            'success' => false,
            'message' => 'Catatan Tidak Ditemukan!',
        ], 404);
    }
}