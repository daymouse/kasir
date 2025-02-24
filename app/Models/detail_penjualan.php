<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_penjualan extends Model
{
    use HasFactory;

    protected $table = 'detail_penjualan';

    public $timestamps = false;
    protected $fillable = [
        'id_transaksi',
        'id_barang',
        'jml_barang',
        'hrg_satuan',
    ];
}
