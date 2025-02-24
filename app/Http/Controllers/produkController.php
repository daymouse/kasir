<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;


class produkController extends Controller
{
    public function index()
    {
        $barangs = barang::all();
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
        ]);

        barang::create([
            'namabarang' => $validasi['namabarang'],
            'harga_barang' => $validasi['harga_barang'],
            'stok' => $validasi['stok'],
        ]);

        return redirect()->route('produk-management');

    }



    public function update(Request $request, $id_barang)
    {
        $validasi = $request->validate([
            'namabarang' => 'required|string|max:40',
            'harga_barang' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $barang = barang::findOrFail($id_barang);

        $barang->update($validasi);

        return redirect()->route('produk-management');
    }

    public function delete($id_barang)
    {
        $barang = barang::find($id_barang);
        $barang->delete();

        return redirect()->route('produk-management');
    }

}
