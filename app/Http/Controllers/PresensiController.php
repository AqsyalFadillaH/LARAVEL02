<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function create()
    {
        return view('presensi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'mata_kuliah' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'status' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        Presensi::create($request->all());

        return redirect()->back()->with('success', 'Presensi berhasil disimpan!');
 }
    public function index()
    {
        $presensis = Presensi::all(); // ambil semua data dari tabel presensis
        return view('presensi.index', compact('presensis'));
}
}