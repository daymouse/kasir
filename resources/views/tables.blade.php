<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Daftar Pelanggan</h6>
                                    <p class="text-sm">Daftar pelanggan dengan pembelian terbanyak</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Member
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Nama</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Pembelian</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Total Transaksi</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($customers as $index => $customer)
                                        <tr>
                                            <td>
                                                <p class="text-sm text-dark font-weight-semibold mb-0">{{ $index + 1 }}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm text-dark font-weight-semibold mb-0">{{ $customer->nama }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-sm font-weight-normal">{{ $customer->jumlah_transaksi }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="badge badge-sm border border-success text-success bg-success"">Rp {{ number_format($customer->total_pembelian, 0, ',', '.') }}</span>
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
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Transaksi Barang</h6>
                                    <p class="text-sm mb-sm-0">Banyak barang dan pendapatan dari barang yang terjual</p>
                                </div>
                                <div class="ms-auto d-flex">
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                                No</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Nama Barang</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Total Terjual
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                                Pendapatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($results as $row)
                                        <tr>
                                            <td>
                                                <p class="text-sm font-weight-normal mb-0">{{ $loop->iteration }}</p>
                                            </td>
                                            <td>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">{{ $row->namabarang }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-sm font-weight-normal">{{ $row->total_terjual }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-sm border border-success text-success bg-success">
                                                    {{ number_format($row->total_pendapatan, 0, ',', '.') }}</span>


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
        </div>
    </main>

</x-app-layout>
