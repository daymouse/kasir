<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelanggan;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class pelangganController extends Controller
{
    public function index(Request $request)
{
    // Validasi input manual agar tetap JSON-friendly
    $validator = Validator::make($request->all(), [
        'nama' => 'required|string|max:40',
        'gender' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

        // Simpan data pelanggan
        Pelanggan::create([
            'nama' => $request->nama,
            'gender' => $request->gender,
        ]);

        return redirect('kasir');
}

    public function create() {
        return view('add_pelanggan'); // Pastikan ada file pelanggan/tambah.blade.php
    }
}
