<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Note;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Fungsi ini mengisi database dengan data awal (Dummy Data)
     * untuk keperluan testing dan demonstrasi aplikasi.
     *
     * @return void
     */
    public function run()
    {
        // Inisialisasi Faker (Generator Data Palsu)
        $faker = Faker::create('id_ID'); // Pakai locale Indonesia biar namanya lokal

        // ---------------------------------------------------
        // 1. BUAT AKUN DEMO (Untuk Login saat Sidang)
        // ---------------------------------------------------
        // Daripada register manual, kita buatkan akun default.
        $user = User::create([
            'name' => 'Mahasiswa Demo',
            'email' => 'demo@enotes.com',
            'password' => Hash::make('password'), // Passwordnya: password
            'email_verified_at' => now(),
        ]);

        $this->command->info('User Demo berhasil dibuat! (Email: demo@enotes.com)');

        // ---------------------------------------------------
        // 2. BUAT CATATAN UNTUK USER DEMO
        // ---------------------------------------------------
        foreach (range(1, 10) as $index) {
            Note::create([
                'user_id' => $user->id, // Hubungkan ke user di atas
                'title' => $faker->sentence(4), // Judul acak 4 kata
                'content' => $faker->paragraph(3), // Isi acak 3 paragraf
                'author' => $user->name,
                'session_token' => null,
            ]);
        }

        // ---------------------------------------------------
        // 3. BUAT CONTOH CATATAN TAMU (GUEST)
        // ---------------------------------------------------
        // Simulasi data yang dibuat oleh orang tanpa login
        foreach (range(1, 5) as $index) {
            Note::create([
                'user_id' => null, // Tidak punya user ID
                'title' => '[Guest] ' . $faker->sentence(3),
                'content' => $faker->paragraph(2),
                'author' => 'Guest User',
                'session_token' => 'dummy_token_for_testing', // Token palsu
            ]);
        }
        
        $this->command->info('Data Dummy Notes berhasil di-generate!');
    }
}