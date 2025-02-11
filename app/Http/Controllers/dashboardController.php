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
        $penjualans = penjualan::all();

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

        return view('dashboard', compact('penjualans', 'results'));
    }
    public function penjualan()
    {
        return view('laravel-examples.penjualan');
    }
}
