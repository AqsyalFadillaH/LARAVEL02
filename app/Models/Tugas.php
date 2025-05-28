<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';
    protected $fillable = ['judul_tugas', 'mata_kuliah', 'deskripsi', 'deadline','file_path'];
}