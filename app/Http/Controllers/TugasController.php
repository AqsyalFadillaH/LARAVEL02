<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tugas; 
class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::all();
        return view('tugas.index', compact('tugas'));}
}