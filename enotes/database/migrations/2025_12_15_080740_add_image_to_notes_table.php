<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::table('notes', function (Blueprint $table) {
        // Menambah kolom 'image' setelah 'content', boleh kosong (nullable)
        $table->string('image')->nullable()->after('content');
    });
}

public function down()
{
    Schema::table('notes', function (Blueprint $table) {
        $table->dropColumn('image');
    });
}
}
