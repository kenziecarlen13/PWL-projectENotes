<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignment).
     * Digunakan saat proses registrasi pengguna baru.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * Atribut yang harus disembunyikan saat serialisasi ke Array/JSON.
     * Penting untuk keamanan agar Password dan Token tidak terekspos di API.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Konversi tipe data otomatis (Type Casting).
     * Kolom 'email_verified_at' otomatis dikonversi menjadi objek Datetime (Carbon).
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Definisi Relasi One-to-Many.
     * Seorang User dapat memiliki banyak (HasMany) catatan (Note).
     * Digunakan untuk mengambil data seperti: Auth::user()->notes;
     * * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}