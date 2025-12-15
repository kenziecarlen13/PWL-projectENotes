<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    /**
     * Atribut yang dapat diisi secara massal (Mass Assignment).
     * Mencegah kerentanan keamanan dengan membatasi kolom yang boleh diinput user.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'image',
        'author',
        'user_id',       // Menyimpan ID User (jika Login)
        'session_token'  // Menyimpan ID Sesi Browser (jika Tamu/Guest)
    ];

    /**
     * Definisi Relasi Inverse One-to-Many.
     * Sebuah catatan dimiliki oleh (Belongs To) satu User.
     * * Catatan: Jika Note dibuat oleh Guest, relasi ini akan mengembalikan null
     * karena kolom user_id bernilai null.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}