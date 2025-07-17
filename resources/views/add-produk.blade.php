<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid px-5 py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="">Add Produk</h5>
                            <p class="text-sm mb-0">Tambah produk baru ke dalam sistem.</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('add-produk') }}" method="POST" enctype="multipart/form-data" id="formProduk">
                                @csrf
                                <div class="mb-3">
                                    <label for="namabarang" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="namabarang" name="namabarang" placeholder="Masukkan nama produk" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga_barang" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="harga_barang" name="harga_barang" placeholder="Masukkan harga produk" required>
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan stok produk" required>
                                </div>
                                <div class="mb-3">
                                    <label for="foto_barang" class="form-label">Foto Produk</label>
                                    <input type="file" class="form-control" id="foto_barang" name="foto_barang" accept="image/*">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ route('produk-management') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>

<!-- Modal Ukuran Gambar Terlalu Besar -->
<div class="modal fade" id="modalUkuran" tabindex="-1" aria-labelledby="modalUkuranLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="modalUkuranLabel">Ukuran Gambar Terlalu Besar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                Ukuran gambar maksimal adalah <strong>2MB</strong>. Silakan pilih gambar yang lebih kecil.
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('formProduk').addEventListener('submit', function (e) {
        const inputFile = document.getElementById('foto_barang');
        if (inputFile.files.length > 0) {
            const file = inputFile.files[0];
            if (file.size > 2 * 1024 * 1024) {
                e.preventDefault();
                const modal = new bootstrap.Modal(document.getElementById('modalUkuran'));
                modal.show();
            }
        }
    });
</script>
</body>
</html>
