<!--
=========================================================
* Corporate UI - v1.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/corporate-ui
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @if (config('app.is_demo'))
        <title itemprop="name">
            Corporate UI Dashboard Laravel by Creative Tim & UPDIVISION
        </title>
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@CreativeTim" />
        <meta name="twitter:creator" content="@CreativeTim" />
        <meta name="twitter:title" content="Corporate UI Dashboard Laravel by Creative Tim & UPDIVISION" />
        <meta name="twitter:description" content="Fullstack tool for building Laravel apps with hundreds of UI components and
            ready-made CRUDs" />
        <meta name="twitter:image"
            content="https://s3.amazonaws.com/creativetim_bucket/products/737/original/corporate-ui-dashboard-laravel.jpg?1695288974" />
        <meta name="twitter:url" content="https://www.creative-tim.com/live/corporate-ui-dashboard-laravel" />
        <meta name="description" content=""Fullstack tool for building Laravel apps with hundreds of UI components
            and ready-made CRUDs">
        <meta name="keywords"
            content="creative tim, updivision, html dashboard, laravel, api, html css dashboard laravel,  Corporate UI Dashboard Laravel,  Corporate UI Laravel,  Corporate Dashboard Laravel, UI Dashboard Laravel, Laravel admin, laravel dashboard, Laravel dashboard, laravel admin, web dashboard, bootstrap 5 dashboard laravel, bootstrap 5, css3 dashboard, bootstrap 5 admin laravel, frontend, responsive bootstrap 5 dashboard, corporate dashboard laravel,  Corporate UI Dashboard Laravel">
        <meta property="og:app_id" content="655968634437471">
        <meta property="og:type" content="product">
        <meta property="og:title" content="Corporate UI Dashboard Laravel by Creative Tim & UPDIVISION">
        <meta property="og:url" content="https://www.creative-tim.com/live/corporate-ui-dashboard-laravel">
        <meta property="og:image"
            content="https://s3.amazonaws.com/creativetim_bucket/products/737/original/corporate-ui-dashboard-laravel.jpg?1695288974">
        <meta property="product:price:amount" content="FREE">
        <meta property="product:price:currency" content="USD">
        <meta property="product:availability" content="in Stock">
        <meta property="product:brand" content="Creative Tim">
        <meta property="product:category" content="Admin &amp; Dashboards">
        <meta name="data-turbolinks-track" content="false">
    @endif
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Corporate UI by Creative Tim & UPDIVISION
    </title>
    <!--     Fonts and icons     -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Noto+Sans:300,400,500,600,700,800|PT+Mono:300,400,500,600,700"
        rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/349ee9c857.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/corporate-ui-dashboard.css?v=1.0.0" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

</head>

<body class="g-sidenav-show  bg-gray-100">
    <x-app.sidebar_kasir :name="'Kasir'" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg p-4 ">
        <x-app.navbar />

        <h4>Keranjang Penjualan</h4>
        <br>


        <div class="row">
            <!-- Sidebar Pencarian -->
            <div class="col-md-4">
                <div class="card card-primary mb-3">
                    <div class="card-header bg-primary text-white">
                        <h5><i class="fa fa-search"></i> Cari Barang</h5>
                    </div>
                    <div class="card-body d-flex flex-column gap-3">
                        <form action="{{ route('pelanggan') }}" method="GET" class="d-flex gap-2">
                            @csrf
                            <input type="text" class="form-control" name="cariPelanggan" placeholder="Masukan ID Pelanggan [ENTER]">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </form>
                        <form action="{{ route('barang2') }}" method="GET" class="d-flex gap-2">
                            @csrf
                            <input type="text" class="form-control" name="cari" placeholder="Masukan Kode/Nama Barang [ENTER]">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Daftar Barang -->
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header bg-primary text-white d-flex align-items-center" style="height: 56px;">
                        <h5 class="mb-0">Daftar Barang</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">


                            <table class="table text-secondary text-center mb-0">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-left">ID</th>
                                        <th class="text-center">Produk</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(request('cari'))
                                        @forelse($daftar_barang as $product)
                                            <form action="{{ route('add') }}" method="POST">
                                                @csrf
                                                <tr>
                                                    <td class="text-left text-secondary">
                                                        <input type="number" class="w-100 bg-transparent text-left border-0"
                                                            name="id" value="{{ $product->id_barang }}" readonly>
                                                    </td>
                                                    <td class="text-center text-secondary">
                                                        <input type="text" class="w-100 bg-transparent text-center border-0"
                                                            name="nama" value="{{ $product->namabarang }}" readonly>
                                                    </td>
                                                    <td class="text-center text-secondary">
                                                        <input type="number" class="w-100 bg-transparent text-center border-0"
                                                            name="harga" value="{{ $product->harga_barang }}" readonly>
                                                    </td>
                                                    <td class="text-center text-secondary">
                                                        <input type="number" class="w-75 text-center bg-transparent border-0"
                                                            name="stok" value="1">
                                                    </td>
                                                    <td class="text-center text-secondary">
                                                        <button type="submit" class="btn btn-primary btn-sm">
                                                            ADD
                                                        </button>
                                                    </td>
                                                </tr>
                                            </form>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Barang tidak ditemukan.</td>
                                            </tr>
                                        @endforelse
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>




            <div class="col-sm-12">
                <div class="card card-primary">
                    <div class="card-header bg-primary text-white">
                        <h5 class="d-flex justify-content-between"> KASIR
                        <a class="btn btn-danger float-right"
                            onclick="javascript:return confirm('Apakah anda ingin reset keranjang ?');" href="{{route('resetkeranjang')}}">
                            <b>RESET KERANJANG</b></a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('bayar') }}" method="POST">
                            @csrf
                            <div id="keranjang" class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="col-sm-4"><b>Tanggal</b></td>
                                        <td>
                                            <input type="text" id="tanggal" name="tanggal" class="form-control"
                                                value="{{ \Carbon\Carbon::now()->isoFormat('YYYY-MM-DD') }}" readonly>
                                        </td>
                                    </tr>
                                </table>

                                <table class="table table-bordered">
                                    <tbody>
                                        @if(session()->has('pelanggan') && count(session('pelanggan')) > 0)
                                            @foreach(session('pelanggan') as $id_pelanggan => $orang)
                                            <tr>
                                                <td class="col-sm-4">
                                                    <b>Pelanggan dengan ID</b><input type="text" name="id_pelanggan" value="{{ $orang['id_pelanggan'] }}" class="form-control bg-transparent border-0" readonly>
                                                </td>
                                                <td>{{ $orang['nama'] }}</td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="col-sm-4">
                                                    <b>Pelanggan dengan ID</b>
                                                </td>
                                                <td colspan="4" class="text-center">Masukkan Id Pelanggan</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                                <table class="table table-bordered w-100" id="example1">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Nama Barang</td>
                                            <td>Harga Satuan</td>
                                            <td>Jumlah</td>
                                            <td>Total</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    @php $no = 1; @endphp
                                    <tbody>
                                        @if(session()->has('keranjang') && count(session('keranjang')) > 0)
                                            @foreach(session('keranjang') as $id => $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>
                                                    <input type="text" name="nama[]" value="{{ $item['nama'] }}"
                                                        class="form-control bg-transparent border-0" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" name="harga[]"
                                                        value="{{$item['harga']}}"
                                                        class="form-control bg-transparent border-0" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="jumlah[]" value="{{ $item['stok'] }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="total[]"
                                                        value="{{$item['total']}}"
                                                        class="form-control bg-transparent border-0" readonly>
                                                </td>
                                                <td>
                                                    <a href="{{ route('hapusItem', $id) }}" class="btn btn-danger btn-sm">Hapus</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center">Keranjang kosong</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <br/>


                            <div id="kasirnya">
                                <table class="table table-stripped">
                                    @if(isset($total_transaksi))
                                    <tr>
                                        <td>Total Semua</td>
                                        <td>
                                            <input type="text" class="form-control" name="total_transaksi"
                                                value="Rp {{ number_format($total_transaksi ?? 0, 0, ',', '.') }}" readonly>
                                        </td>
                                        <td>Bayar</td>
                                        <td>
                                            <input type="number" class="form-control" name="bayar" min="0" required>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td>
                                            <input type="submit" class="btn btn-danger" value="Bayar">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                        <div class="d-flex align-items-center gap-3">
                            @if(isset($kembalian))
                                <span>Kembali:</span>
                                <input type="text" class="form-control w-auto" name="kembali" value="{{$kembalian}}" readonly>
                                <a href="{{route('invoice')}}" class="btn btn-primary">Cetak Nota</a>
                            @endif
                        </div>
                        @yield('invoice')
                    </div>
                </div>
            </div>
        </div>


    <script>
       function updateTanggal() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0'); // Tambah 1 karena Januari = 0
            const day = String(now.getDate()).padStart(2, '0');
            document.getElementById("tanggal").textContent = `${year}-${month}-${day}`;
        }

        // Panggil saat halaman dimuat
        updateTanggal();

        // Update setiap detik (opsional, jika ingin selalu real-time)
        setInterval(updateTanggal, 1000);ountry name
    </script>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script src="../assets/js/plugins/swiper-bundle.min.js" type="text/javascript"></script>
    <script>
        if (document.getElementsByClassName('mySwiper')) {
            var swiper = new Swiper(".mySwiper", {
                effect: "cards",
                grabCursor: true,
                initialSlide: 1,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        };


        var ctx = document.getElementById("chart-bars").getContext("2d");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"],
                datasets: [{
                        label: "Sales",
                        tension: 0.4,
                        borderWidth: 0,
                        borderSkipped: false,
                        backgroundColor: "#2ca8ff",
                        data: [450, 200, 100, 220, 500, 100, 400, 230, 500, 200],
                        maxBarThickness: 6
                    },
                    {
                        label: "Sales",
                        tension: 0.4,
                        borderWidth: 0,
                        borderSkipped: false,
                        backgroundColor: "#7c3aed",
                        data: [200, 300, 200, 420, 400, 200, 300, 430, 400, 300],
                        maxBarThickness: 6
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#1e293b',
                        bodyColor: '#1e293b',
                        borderColor: '#e9ecef',
                        borderWidth: 1,
                        usePointStyle: true
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        stacked: true,
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [4, 4],
                        },
                        ticks: {
                            beginAtZero: true,
                            padding: 10,
                            font: {
                                size: 12,
                                family: "Noto Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#64748B"
                        },
                    },
                    x: {
                        stacked: true,
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false
                        },
                        ticks: {
                            font: {
                                size: 12,
                                family: "Noto Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#64748B"
                        },
                    },
                },
            },
        });


        var ctx2 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(45,168,255,0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(45,168,255,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(45,168,255,0)'); //blue colors

        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, 'rgba(119,77,211,0.4)');
        gradientStroke2.addColorStop(0.7, 'rgba(119,77,211,0.1)');
        gradientStroke2.addColorStop(0, 'rgba(119,77,211,0)'); //purple colors

        new Chart(ctx2, {
            plugins: [{
                beforeInit(chart) {
                    const originalFit = chart.legend.fit;
                    chart.legend.fit = function fit() {
                        originalFit.bind(chart.legend)();
                        this.height += 40;
                    }
                },
            }],
            type: "line",
            data: {
                labels: ["Aug 18", "Aug 19", "Aug 20", "Aug 21", "Aug 22", "Aug 23", "Aug 24", "Aug 25", "Aug 26",
                    "Aug 27", "Aug 28", "Aug 29", "Aug 30", "Aug 31", "Sept 01", "Sept 02", "Sept 03", "Aug 22",
                    "Sept 04", "Sept 05", "Sept 06", "Sept 07", "Sept 08", "Sept 09"
                ],
                datasets: [{
                        label: "Volume",
                        tension: 0,
                        borderWidth: 2,
                        pointRadius: 3,
                        borderColor: "#2ca8ff",
                        pointBorderColor: '#2ca8ff',
                        pointBackgroundColor: '#2ca8ff',
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: [2828, 1291, 3360, 3223, 1630, 980, 2059, 3092, 1831, 1842, 1902, 1478, 1123,
                            2444, 2636, 2593, 2885, 1764, 898, 1356, 2573, 3382, 2858, 4228
                        ],
                        maxBarThickness: 6

                    },
                    {
                        label: "Trade",
                        tension: 0,
                        borderWidth: 2,
                        pointRadius: 3,
                        borderColor: "#832bf9",
                        pointBorderColor: '#832bf9',
                        pointBackgroundColor: '#832bf9',
                        backgroundColor: gradientStroke2,
                        fill: true,
                        data: [2797, 2182, 1069, 2098, 3309, 3881, 2059, 3239, 6215, 2185, 2115, 5430, 4648,
                            2444, 2161, 3018, 1153, 1068, 2192, 1152, 2129, 1396, 2067, 1215, 712, 2462,
                            1669, 2360, 2787, 861
                        ],
                        maxBarThickness: 6
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        align: 'end',
                        labels: {
                            boxWidth: 6,
                            boxHeight: 6,
                            padding: 20,
                            pointStyle: 'circle',
                            borderRadius: 50,
                            usePointStyle: true,
                            font: {
                                weight: 400,
                            },
                        },
                    },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#1e293b',
                        bodyColor: '#1e293b',
                        borderColor: '#e9ecef',
                        borderWidth: 1,
                        pointRadius: 2,
                        usePointStyle: true,
                        boxWidth: 8,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [4, 4]
                        },
                        ticks: {
                            callback: function(value, index, ticks) {
                                return parseInt(value).toLocaleString() + ' EUR';
                            },
                            display: true,
                            padding: 10,
                            color: '#b2b9bf',
                            font: {
                                size: 12,
                                family: "Noto Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#64748B"
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [4, 4]
                        },
                        ticks: {
                            display: true,
                            color: '#b2b9bf',
                            padding: 20,
                            font: {
                                size: 12,
                                family: "Noto Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#64748B"
                        }
                    },
                },
            },
        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Corporate UI Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/corporate-ui-dashboard.min.js?v=1.0.0"></script>
</body>

</html>
