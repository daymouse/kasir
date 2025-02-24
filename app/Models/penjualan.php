<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';

    public $timestamps = false;
    protected $fillable = [
        'id_pelanggan',
        'tgl_transaksi',
        'total_harga',
    ];
}
