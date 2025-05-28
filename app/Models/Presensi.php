<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensis';
    protected $fillable = ['nama_mahasiswa', 'mata_kuliah', 'tanggal','status'];
}