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
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('content');
            $table->string('image')->nullable();
            $table->string('author');
            
            $table->unsignedBigInteger('user_id')->nullable(); // Untuk Member
            $table->string('session_token')->nullable();       // Untuk Tamu
            
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