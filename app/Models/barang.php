<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id_barang';
    protected $table = 'barang';
    protected $fillable = ['id_barang', 'namabarang', 'harga_barang', 'stok'];
}
