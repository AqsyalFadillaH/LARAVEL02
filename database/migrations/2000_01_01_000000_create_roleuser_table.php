<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roleuser', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->timestamps();
        });

        DB::table('roleuser')->insert([
            ['role' => 'mahasiswa', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'dosen', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'admin', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('roleuser');
    }
};