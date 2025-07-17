<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penjualan;
use App\Models\detail_penjualan;
use Illuminate\Support\Facades\DB;

class tableController extends Controller
{
    public function topCustomers()
    {
        $customers = DB::table('penjualan')
            ->join('pelanggan', 'penjualan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->select(
                'pelanggan.id_pelanggan',
                'pelanggan.nama',
                DB::raw('SUM(penjualan.total_harga) as total_pembelian'),
                DB::raw('COUNT(penjualan.id_transaksi) as jumlah_transaksi')
            )
            ->groupBy('pelanggan.id_pelanggan', 'pelanggan.nama')
            ->orderByDesc('total_pembelian') // Urutkan dari yang terbesar
            ->get();

         $query = DB::table('detail_penjualan')
            ->join('barang', 'detail_penjualan.id_barang', '=', 'barang.id_barang')
            ->select(
                'barang.namabarang',
                DB::raw('SUM(detail_penjualan.jml_barang) as total_terjual'),
                DB::raw('SUM(detail_penjualan.jml_barang * detail_penjualan.hrg_satuan) as total_pendapatan')
            )
            ->groupBy('barang.namabarang')
            ->orderBy('total_terjual', 'desc'); // Urutkan berdasarkan jumlah terbanyak


        $results = $query->get();


        return view('tables', compact('customers', 'results'));
    }

}
