<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/remenpartdua.png">
    <link rel="icon" type="image/png" href="../assets/img/remenpartdua.png">
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />

        <div class="container-fluid px-5 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-0">Produk</h4>
                    <small class="text-muted">Produk yang kami jual</small>
                </div>
                <a href="{{ route('addproduk') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Produk
                </a>
            </div>

            <div class="row">
                @forelse ($barangs as $barang)
                    <div class="col-md-2 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if($barang->foto_barang)
                                <img src="{{ asset('storage/' . $barang->foto_barang) }}" class="card-img-top" alt="Gambar Produk" style="height: 220px; object-fit: cover;">
                            @else
                                <img src="https://via.placeholder.com/400x220?text=No+Image" class="card-img-top" alt="Tidak ada gambar">
                            @endif

                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title">{{ $barang->namabarang }}</h5>
                                    <p class="card-text text-muted mb-1">Harga: <strong>Rp {{ number_format($barang->harga_barang, 0, ',', '.') }}</strong></p>
                                    <p class="card-text text-muted">Stok:
                                        <span class="badge bg-success">{{ $barang->stok }}</span>
                                    </p>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('editproduk', $barang->id_barang) }}" class="btn btn-sm btn-warning me-2">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="{{ route('delate-produk', $barang->id_barang) }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                        <i class="bi bi-trash3"></i> Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">Belum ada produk yang tersedia.</div>
                    </div>
                @endforelse
            </div>
        </div>

        <x-app.footer />
    </main>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
