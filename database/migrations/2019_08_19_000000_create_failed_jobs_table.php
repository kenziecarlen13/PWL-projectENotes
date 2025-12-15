<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailedJobsTable extends Migration
{
    /**
     * Run the migrations.
     * Membuat tabel 'failed_jobs' untuk menyimpan log antrian (Queue) yang gagal.
     * Tabel ini berguna untuk debugging jika ada proses background (seperti kirim email) yang error.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            // Informasi koneksi & antrian (misal: database, redis)
            $table->text('connection');
            $table->text('queue');

            // Data pekerjaan yang gagal (Format JSON)
            // Menggunakan longText karena datanya bisa sangat besar
            $table->longText('payload');

            // Pesan error lengkap (Stack Trace)
            $table->longText('exception');

            // Waktu kegagalan (Otomatis terisi waktu sekarang)
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('failed_jobs');
    }
}