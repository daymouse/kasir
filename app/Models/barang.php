<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang'; // gunakan 'barangs' jika tabel di migration adalah 'barangs'
    protected $primaryKey = 'id_barang';
    public $incrementing = true;
    public $timestamps = true; // aktifkan timestamps jika pakai ->timestamps() di migration

    protected $fillable = [
        'namabarang',
        'harga_barang',
        'stok',
        'foto_barang',
    ];
}

