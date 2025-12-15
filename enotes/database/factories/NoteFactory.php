<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Note;
use App\User;
use Faker\Generator as Faker;

$factory->define(Note::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),           // Judul acak (4 kata)
        'content' => $faker->paragraph(3),        // Isi acak (3 paragraf)
        'image' => null,                          // Gambar kosong dulu biar aman
        'author' => $faker->name,                 // Nama penulis acak
        'user_id' => function () {
            // Ambil ID random dari tabel users, atau buat user baru jika kosong
            return User::inRandomOrder()->first()->id ?? factory(User::class)->create()->id;
        },
        'session_token' => null,                  // Kosongkan karena ini simulasi data Member
        'created_at' => $faker->dateTimeBetween('-1 month', 'now'), // Waktu acak
    ];
});