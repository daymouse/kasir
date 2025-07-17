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
        $barang = barang::all();
        $pelanggan = pelanggan::all();
        $cart = session()->get('keranjang', []);
        $total_transaksi = !empty($cart) ? array_sum(array_column($cart, 'total')) : 0;
        $bayar = isset($request->kembalian) ? ($total_transaksi - $request->kembalian) : 0;

        return view('kasir', compact('total_transaksi', 'bayar', 'barang', 'pelanggan'));
    }


   public function cariPelanggan(Request $request)
   {
    $query = $request->input('cariPelanggan');
    $barang = barang::all();
    $pelanggan = pelanggan::all();


    if ($query) {
        $daftar_pelanggan = pelanggan::where('id_pelanggan', 'LIKE', "%{$query}%")->get();
    } else {
        $daftar_pelanggan = collect();
    }
    session()->put('pelanggan', $daftar_pelanggan);


    return view('kasir', compact('daftar_pelanggan','query', 'barang', 'pelanggan'));
   }

   public function caribarang(Request $request)
   {
    $query = $request->input('cari');
    $barang = barang::all();
    $pelanggan = pelanggan::all();

    if ($query) {
        $daftar_barang = barang::where('id_barang', 'LIKE', "%{$query}%")->get();
    } else {
        $daftar_barang = collect();
    }
    session()->put('barang', $daftar_barang);


    return view('kasir', compact('daftar_barang','query', 'barang', 'pelanggan'));
   }
   public function tambahPelanggan(Request $request)
   {
    $barang = barang::all();
    $pelanggan = pelanggan::all();
    $pelanggan = session()->get('pelanggan');
    $id_pelanggan = $request->idPelanggan;
    $nama_pelanggan = $request->namaPelanggan;

    $pelanggan[]=[
        'id_pelanggan' => $id_pelanggan,
        'nama' => $nama_pelanggan,
    ];
    session()->put('pelanggan', $pelanggan);
    return redirect('kasir');
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

        return redirect('kasir');
    }

    public function viewPel()
    {
        $pelanggan = session('pelanggan');
        return view('kasir', compact('pelanggan'));
    }


    public function viewCart()
    {
        $keranjang = session('keranjang', []);
        return view('kasir', compact('keranjang'));
    }

    public function pembayaran(Request $request)
    {
        $cart = session()->get('keranjang', []);
        $total_transaksi = !empty($cart) ? array_sum(array_column($cart, 'total')) : 0;

        $bayar = $request->bayar ?? 0;
        if ($bayar < $total_transaksi) {
            return redirect()->back()->with('error', 'Pembayaran kurang!');
        }

        $kembalian = $bayar - $total_transaksi;

        return view('kasir', compact('total_transaksi', 'bayar', 'kembalian'));
    }

    public function checkout(Request $request)
    {
        $barang = barang::all();
        $pelanggan = pelanggan::all();
        $total_transaksi = (int) str_replace(['Rp', '.', ','], '', $request->total_transaksi);

        $request->merge(['total_transaksi' => $total_transaksi]);
        $request->validate([
            'id_pelanggan' => 'required|integer',
            'bayar' => 'required|numeric|min:0',
            'total_transaksi' => 'required|numeric|min:1',
        ]);

        $cart = session()->get('keranjang');
        if (!$cart || empty($cart)) {
            return response()->json(['message' => 'Keranjang kosong'], 400);
        }

        $total_harga = array_sum(array_map(fn($item) => $item['total'], $cart));
        $kembalian = $request->bayar - $total_harga;

        if ($request->bayar < $total_harga) {
            return response()->json(['message' => 'Pembayaran kurang'], 400);
        }


        DB::beginTransaction();
        try {
            Log::info('Mulai transaksi checkout', ['data' => $request->all()]);

            $order = Penjualan::create([
                'id_pelanggan' => $request->id_pelanggan,
                'total_harga' => $total_transaksi,
                'tgl_transaksi' => now(),
            ]);

            foreach ($cart as $item) {
                detail_Penjualan::create([
                    'id_transaksi' => $order->id,
                    'id_barang' => $item['id'],
                    'jml_barang' => $item['stok'],
                    'hrg_satuan' => $item['harga'],
                ]);

                Barang::where('id_barang', $item['id'])->decrement('stok', $item['stok']);
            }

            DB::commit();

            session([
                'invoice_data' => [
                    'id_transaksi' => $order->id,
                    'id_pelanggan' => $request->id_pelanggan,
                    'total_harga' => $total_harga,
                    'bayar' => $request->bayar,
                    'kembalian' => $kembalian,
                    'items' => $cart,
                    'nama_pelanggan' => $request->namaPelanggan,
                ]
            ]);


            return view('kasir', compact('kembalian', 'barang', 'pelanggan'));// Arahkan ke invoice
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Terjadi kesalahan', 'error' => $e->getMessage()], 500);
        }
    }


    public function invoice()
    {
        $barang = barang::all();
         $pelanggan = pelanggan::all();
        $invoiceData = session()->get('invoice_data', []);
        return view('invoice', compact('invoiceData', 'barang', 'pelanggan'));
    }

    public function hapusItem($id)
    {
        $cart = session()->get('keranjang', []);
        unset($cart[$id]);
        session()->put('keranjang', $cart);

        return redirect('kasir');
    }

    public function hapusPelanggan()
    {
        session()->forget('pelanggan');
        return redirect('kasir');
    }

    public function resetkeranjang()
    {
        session()->forget('keranjang');
        session()->forget('pelanggan');
        session()->forget('invoice_data');
        return redirect('kasir');
    }

}
