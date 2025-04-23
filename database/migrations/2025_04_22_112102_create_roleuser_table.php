<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roleuser', function (Blueprint $table) {
            $table->id();
            $table->string('role'); // Tambahkan kolom role
            $table->timestamps();
        });

        // Optional: Masukkan role default (jika kamu ingin langsung ada datanya)
        DB::table('roleuser')->insert([
            ['role' => 'mahasiswa', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'dosen', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'admin', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roleuser');
    }
};
