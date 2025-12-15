<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Mengubah resource (Model) menjadi bentuk Array.
     * Fungsi ini mengatur format JSON yang akan dikirimkan oleh API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'content'       => $this->content,
            
            // Mengambil nama user dari relasi.
            // Menggunakan Null Coalescing Operator (??) untuk menangani Guest Mode.
            // Jika user tidak ada (null), maka tampilkan 'Guest User'.
            'author'        => $this->user->name ?? 'Guest User',
            
            // Formatting tanggal agar lebih mudah dibaca oleh client (Frontend/Mobile App)
            'created_at'    => $this->created_at->format('d-m-Y H:i'),
            'updated_at'    => $this->updated_at->format('d-m-Y H:i'),
        ];
    }
}