<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;

class produkController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('laravel-examples.produk', compact('barangs'));
    }

    public function edit($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        return view('edit-produk', compact('barang'));
    }

    public function add(Request $request)
    {
        $validasi = $request->validate([
            'namabarang' => 'required|string|max:40',
            'harga_barang' => 'required|numeric',
            'stok' => 'required|numeric',
            'foto_barang' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // max 2MB
        ]);

        // Upload file jika ada
        if ($request->hasFile('foto_barang')) {
            $file = $request->file('foto_barang');
            $path = $file->store('foto_barang', 'public'); // simpan di storage/app/public/foto_barang
            $validasi['foto_barang'] = $path;
        }

        Barang::create($validasi);

        return redirect()->route('produk-management')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, $id_barang)
    {
        $validasi = $request->validate([
            'namabarang' => 'required|string|max:40',
            'harga_barang' => 'required|numeric',
            'stok' => 'required|numeric',
            'foto_barang' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $barang = Barang::findOrFail($id_barang);

        // Jika ada file baru, hapus file lama dan upload baru
        if ($request->hasFile('foto_barang')) {
            // Hapus foto lama jika ada
            if ($barang->foto_barang && Storage::disk('public')->exists($barang->foto_barang)) {
                Storage::disk('public')->delete($barang->foto_barang);
            }

            $file = $request->file('foto_barang');
            $path = $file->store('foto_barang', 'public');
            $validasi['foto_barang'] = $path;
        }

        $barang->update($validasi);

        return redirect()->route('produk-management')->with('success', 'Produk berhasil diperbarui.');
    }

    public function delete($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);

        // Hapus gambar jika ada
        if ($barang->foto_barang && Storage::disk('public')->exists($barang->foto_barang)) {
            Storage::disk('public')->delete($barang->foto_barang);
        }

        $barang->delete();

        return redirect()->route('produk-management')->with('success', 'Produk berhasil dihapus.');
    }
}
