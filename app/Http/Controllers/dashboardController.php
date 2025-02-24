<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penjualan;
use App\Models\detail_penjualan;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function index()
    {
        $results = DB::table('penjualan')
            ->join('detail_penjualan', 'penjualan.id_transaksi', '=', 'detail_penjualan.id_transaksi')
            ->select(
                'penjualan.id_transaksi',
                'detail_penjualan.id_barang',
                'detail_penjualan.jml_barang',
                'detail_penjualan.hrg_satuan',
                'penjualan.tgl_transaksi',
                'penjualan.total_harga'
            )
            ->get();

            $totalhrgbarang = DB::table('detail_penjualan')
            ->select(DB::raw('SUM(jml_barang * hrg_satuan) as total_harga_barang'))
            ->value('total_harga_barang') ?? 0;


            $totalTransaksi = DB::table('penjualan')->count();

            $rataRataPembelian = DB::table('penjualan')
            ->selectRaw('SUM(total_harga) / COUNT(DISTINCT id_pelanggan) as rata_rata')
            ->value('rata_rata');

            $jumlah_stok = DB::table('barang')
            ->selectRaw('SUM(stok) as total_stok')
            ->value('total_stok');

            $penjualan = DB::table('penjualan')
            ->selectRaw('DATE(tgl_transaksi) as tanggal, SUM(total_harga) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->get();

            $labels = $penjualan->pluck('tanggal');
            $data = $penjualan->pluck('total');


        return view('dashboard', compact('results' , 'totalhrgbarang', 'totalTransaksi', 'rataRataPembelian', 'jumlah_stok', 'labels', 'data'));
    }
    public function filter(Request $request)
    {
        $query = DB::table('penjualan')
            ->join('detail_penjualan', 'penjualan.id_transaksi', '=', 'detail_penjualan.id_transaksi')
            ->select(
                'penjualan.id_transaksi',
                'detail_penjualan.id_barang',
                'detail_penjualan.jml_barang',
                'detail_penjualan.hrg_satuan',
                'penjualan.tgl_transaksi',
                'penjualan.total_harga'
            );


        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $query->whereBetween('penjualan.tgl_transaksi', [$request->tgl_awal, $request->tgl_akhir]);
        }

        $results = $query->get();

        return view('dashboard', compact('results'));
    }

    public function penjualan()
    {
        return view('laravel-examples.penjualan');
    }
}
