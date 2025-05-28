<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensisTable extends Migration
{
    public function up()
    {
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mahasiswa');
            $table->string('mata_kuliah');
            $table->date('tanggal');
            $table->enum('status', ['hadir', 'sakit', 'izin', 'alfa']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('presensis');}
}