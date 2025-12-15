<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * Membuat tabel 'users' untuk menyimpan data otentikasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // Primary Key (Auto Increment Big Integer)
            $table->bigIncrements('id');

            // Data Diri Dasar
            $table->string('name');
            $table->string('email')->unique(); // Email wajib unik untuk login

            // Verifikasi Email (Nullable: Boleh kosong jika belum verifikasi)
            $table->timestamp('email_verified_at')->nullable();

            // Password (Akan di-hash menggunakan Bcrypt)
            $table->string('password');

            // Token Keamanan
            $table->rememberToken(); // Untuk fitur "Remember Me" (menyimpan sesi login)
            
            // Audit Log (created_at & updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Menghapus tabel users jika dilakukan rollback.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}