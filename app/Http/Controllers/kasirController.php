<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\detail_penjualan;
use App\Models\penjualan;
use Illuminate\Support\Facades\DB;
use App\Models\pelanggan;
use Illuminate\Support\Facades\Log;

class kasirController extends Controller
{
    public function index(Request $request)
    {
        $barangs = barang::all();
        $pelanggan = pelanggan::all();
        $cart = session()->get('keranjang', []);
        $total_transaksi = !empty($cart) ? array_sum(array_column($cart, 'total')) : 0;
        $bayar = isset($request->kembalian) ? ($total_transaksi - $request->kembalian) : 0;

        return view('kasir', compact('total_transaksi', 'bayar', 'barangs', 'pelanggan', 'cart'));
    }

    public function caribarang(Request $request)
    {
        $query = $request->input('cari');
        $barang = barang::query();

        if ($query) {
            $barang->where('id_barang', 'LIKE', "%{$query}%")
                  ->orWhere('namabarang', 'LIKE', "%{$query}%");
        }

        $barangs = $barang->get();

        return response()->json($barangs);
    }

    public function tambahkeranjang(Request $request)
    {
        $cart = session()->get('keranjang', []);

        foreach ($request->items as $item) {
            $id = $item['id'];
            $nama = $item['nama'];
            $harga = $item['harga'];
            $stokBaru = $item['stok'] ?? 1;

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
        }

        session()->put('keranjang', $cart);

        return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang']);
    }

    public function viewCart()
    {
        $keranjang = session('keranjang', []);
        return response()->json($keranjang);
    }

    public function checkout(Request $request)
    {
    $request->validate([
                'id_pelanggan' => 'required|integer',
                'bayar' => 'required|numeric|min:0',
                'total' => 'required|numeric|min:1',
                'keranjang' => 'required|array|min:1',
                'keranjang.*.id' => 'required|integer|exists:barang,id_barang',
                'keranjang.*.nama' => 'required|string',
                'keranjang.*.qty' => 'required|integer|min:1',
                'keranjang.*.harga' => 'required|numeric|min:0',
            ]);

            DB::beginTransaction();
            try {
                // Simpan ke tabel penjualan
                $penjualan = penjualan::create([
                    'id_pelanggan' => $request->id_pelanggan,
                    'tgl_transaksi' => now(),
                    'total_harga' => $request->total,
                ]);

                // Simpan ke tabel detail_penjualan
                foreach ($request->keranjang as $item) {
                    detail_penjualan::create([
                        'id_transaksi' => $penjualan->id,
                        'id_barang' => $item['id'],
                        'jml_barang' => $item['qty'],
                        'hrg_satuan' => $item['harga'],
                    ]);

                    // Update stok barang
                    barang::where('id_barang', $item['id'])->decrement('stok', $item['qty']);
                }

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Transaksi berhasil disimpan.',
                    'data' => [
                        'id_penjualan' => $penjualan->id,
                        'total' => $penjualan->total_harga,
                        'tgl_transaksi' => $penjualan->tgl_transaksi,
                        'barang' => $request->keranjang,
                    ]
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menyimpan transaksi.',
                    'error' => $e->getMessage(),
                ], 500);
            }
    }

    public function invoice()
    {
        $invoiceData = session()->get('invoice_data', []);
        return view('invoice', compact('invoiceData'));
    }

    public function hapusItem($id)
    {
        $cart = session()->get('keranjang', []);
        unset($cart[$id]);
        session()->put('keranjang', $cart);

        return response()->json(['message' => 'Item dihapus dari keranjang']);
    }

    public function resetkeranjang()
    {
        session()->forget('keranjang');
        session()->forget('pelanggan');
        session()->forget('invoice_data');
        return redirect('kasir');
    }
}
