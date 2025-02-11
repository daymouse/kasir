<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\detail_penjualan;
use App\Models\penjualan;
use Illuminate\Support\Facades\DB;
use App\Models\pelanggan;

class kasirController extends Controller
{
   public function cari(Request $request)
   {
       $barang = barang::where('id_barang', 'LIKE', '%'. $request->cari.'%')->get();

       return view('kasir', compact('barang'));
   }

   public function cariPelanggan(Request $request)
   {
        $query = $request->input('cariPelanggan');


        if ($query) {
            $daftar_pelanggan = pelanggan::where('id_pelanggan', 'LIKE', "%{$query}%")->get();
        } else {
            $daftar_pelanggan = collect();
        }
        session()->put('pelanggan', $daftar_pelanggan);

        return view('kasir', compact('daftar_pelanggan','query'));
   }

   public function index(Request $request)
   {
    $query = $request->input('cari');


    if ($query) {
        $daftar_barang = barang::where('id_barang', 'LIKE', "%{$query}%")->get();
    } else {
        $daftar_barang = collect();
    }
    session()->put('barang', $daftar_barang);

    return view('kasir', compact('daftar_barang','query'));
   }

   public function tambahkeranjang(Request $request)
{
    $cart = session()->get('keranjang', []);

    $id = $request->id;
    $nama = $request->nama;
    $harga = $request->harga;
    $stokBaru = $request->stok ?? 1;

    if (isset($cart[$id])) {
        $cart[$id]['stok'] += $stokBaru;
        $cart[$id]['total'] = $cart[$id]['harga'] * $cart[$id]['stok'];
    } else {
        $cart[$id] = [
            "id" => $id,
            "nama" => $nama,
            "harga" => $harga,
            "stok" => $stokBaru,
            "total" => $harga * $stokBaru,
        ];
    }

    session()->put('keranjang', $cart);

    return view('kasir');
}

public function viewCart()
{
    $keranjang = session('keranjang', []);
    return view('kasir', compact('keranjang'));
}

public function checkout(Request $request)
{
    $cart = session()->get('keranjang');

    if (!$cart) {
        return response()->json(['message' => 'Keranjang kosong'], 400);
    }

    DB::beginTransaction();
    try {
        $order = penjualan::create([
            'id_pelangan' => $request->id_pelanggan,
            'tgl_transaksi' => $request->tanggal,
            'total_harga' => array_sum(array_column($cart, 'total')),
        ]);

        foreach ($cart as $item) {
            detail_penjualan::create([
                'id_transaksi' => $order->id,
                'id_barang' => $item['id'],
                'jml_barang' => $item['stok'],
                'hrg_barang' => $item['harga']
            ]);
        }

        session()->forget('keranjang');

        DB::commit();
        return response()->json(['message' => 'Pembayaran berhasil']);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => 'Terjadi kesalahan'], 500);
    }
}


}
