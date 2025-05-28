<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwals';
    protected $fillable = ['mata_kuliah', 'dosen', 'ruangan', 'tanggal', 'jam_mulai', 'jam_selesai'];
}