<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     * Membuat struktur tabel 'notes' untuk menyimpan data catatan.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            // Primary Key
            $table->bigIncrements('id');

            // Foreign Key untuk User (Relasi ke tabel users)
            // Awalnya wajib diisi (untuk member), nanti diubah jadi nullable oleh migrasi Guest Mode.
            $table->unsignedBigInteger('user_id');

            // Data Inti Catatan
            $table->string('title'); // Judul
            $table->text('content'); // Isi (Tipe Text agar muat banyak)

            // Metadata Tambahan
            $table->string('author')->nullable(); // Nama penulis (snapshot saat dibuat)
            
            // Audit Log (created_at & updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}