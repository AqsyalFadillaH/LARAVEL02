<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasTable extends Migration
{
    public function up()
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->string('judul_tugas');
            $table->string('mata_kuliah');
            $table->text('deskripsi')->nullable();
            $table->date('deadline');
            $table->string('file_path')->nullable(); // Untuk upload file tugas
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tugas');}
}