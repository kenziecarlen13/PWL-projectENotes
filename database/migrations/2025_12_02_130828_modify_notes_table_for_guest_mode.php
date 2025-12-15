<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyNotesTableForGuestMode extends Migration
{
    /**
     * Run the migrations.
     * Memodifikasi tabel 'notes' untuk mendukung fitur Guest Mode.
     * Mengubah kolom user_id menjadi nullable dan menambahkan session_token.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            // 1. Ubah user_id menjadi Nullable
            // Agar tamu (yang tidak punya ID) tetap bisa menyimpan catatan.
            // Membutuhkan paket 'doctrine/dbal'.
            $table->unsignedBigInteger('user_id')->nullable()->change();

            // 2. Tambah kolom session_token
            // Digunakan sebagai identitas alternatif bagi tamu (pengganti User ID).
            // Di-index untuk mempercepat pencarian query.
            $table->string('session_token')->nullable()->after('user_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     * Mengembalikan struktur tabel ke kondisi semula (Strict Mode).
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notes', function (Blueprint $table) {
            // Kembalikan user_id menjadi wajib diisi (NOT NULL)
            // Hati-hati: Data dengan user_id NULL harus dihapus/diisi dulu sebelum rollback
            $table->unsignedBigInteger('user_id')->nullable(false)->change();

            // Hapus kolom session_token
            $table->dropColumn('session_token');
        });
    }
}