<?php

use Illuminate\Database\Seeder;
use App\Note; // Import Model Note
use Carbon\Carbon;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Mengisi tabel notes dengan data statis (hardcoded).
     * Berguna untuk memastikan selalu ada satu data pasti saat aplikasi di-reset.
     *
     * @return void
     */
    public function run()
    {
        // Menggunakan Eloquent (Model) agar lebih bersih daripada DB::table
        Note::create([
            'user_id' => 1, // Pastikan ini terhubung ke User ID 1 (Akun Demo)
            'title'   => 'Catatan Pertama',
            'content' => 'Halo! Ini adalah catatan statis yang dibuat otomatis oleh NoteSeeder.',
            'author'  => 'Ken', // Nama statis
            'session_token' => null, // Null karena ini milik Member (bukan Guest)
        ]);
    }
}