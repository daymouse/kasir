<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card">
                        <div class="pb-0 card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">produk</h5>
                                    <p class="mb-0 text-sm">
                                        Produk yang kami jual                                  </p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('addproduk') }}" class="btn btn-dark btn-primary">
                                         Tambah Produk
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-secondary text-center">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            ID</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Produk</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Harga</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Stok</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangs as $barang )
                                    <tr>
                                        <td class="align-middle bg-transparent border-bottom">{{$barang ->id_barang}}</td>


                                        <td class="align-middle bg-transparent border-bottom">{{$barang ->namabarang}}</td>
                                        <td class="text-center align-middle bg-transparent border-bottom">{{$barang ->harga_barang}}</td>
                                        <td class="text-center align-middle bg-transparent border-bottom">
                                            <span class="badge badge-sm border border-success text-success bg-success">{{$barang ->stok}}</span>
                                        </td>
                                        <td class="text-center align-middle bg-transparent border-bottom">
                                            <a href="{{ route('editproduk', $barang->id_barang) }}"><i class="bi bi-pencil-square p-2"></i></i></a>
                                            <a href="{{ route('delate-produk', $barang->id_barang)}}"><i class="bi bi-trash3 p-2"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>




            </div>
        </div>
        <x-app.footer />
    </main>

</x-app-layout>

<script src="/assets/js/plugins/datatables.js"></script>
<script>
    const dataTableBasic = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: true,
        columns: [{
            select: [2, 6],
            sortable: false
        }]
    });
</script>

</body>
</html>
