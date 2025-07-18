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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/remen.svg">
    <link rel="icon" type="image/png" href="../assets/img/remen.svg">
    <title>
        REMEN COFFE
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        #keranjangList .form-control-sm {
        max-width: 70px;
    }
    </style>

</head>

<body class="g-sidenav-show  bg-gray-100">
    <x-app.sidebar_kasir :name="'Kasir'" />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg p-4 ">
        <x-app.navbar />
    <div class="container-fluid p-4" style="background-color: #FAF9F6;">
    <div class="row">
        <!-- Kolom Kiri: Daftar Produk -->
        <div class="col-md-8">
            <h4 class="mb-3" style="color: #4E342E;">☕ Daftar Produk</h4>
            <input type="text" class="form-control mb-3" id="searchInput" placeholder="Cari berdasarkan ID atau Nama Produk" style="border-color: #BB9587;">

            <div class="row" id="produkContainer">
                <div class="row d-none" id="pelangganContainer"></div>

                @foreach ($barangs as $barang)
                    <div class="col-md-3 mb-4 produk-item" data-id="{{ $barang->id_barang }}" data-nama="{{ strtolower($barang->namabarang) }}" data-harga="{{ $barang->harga_barang }}">
                        <div class="card card-hover shadow-sm" onclick="selectProduk({{ $barang->id_barang }})" style="cursor: pointer; border: 1px solid #e0d8ce;">
                            @if($barang->foto_barang)
                                <img src="{{ asset('storage/' . $barang->foto_barang) }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                            @else
                                <img src="https://via.placeholder.com/400x180?text=No+Image" class="card-img-top">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title mb-1 text-dark">{{ $barang->namabarang }}</h5>
                                <p class="card-text mb-1 text-muted small">Harga: Rp {{ number_format($barang->harga_barang, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Kolom Kanan: Keranjang Pembelian -->
        <div class="col-md-4">
            <h4 class="mb-3" style="color: #4E342E;">🧾 Nota Pembelian</h4>

            <div class="mb-3 position-relative">
                <label for="cariPelanggan" class="form-label text-muted">Cari Pelanggan</label>
                <input type="text" class="form-control" id="inputPelanggan" placeholder="Pilih pelanggan..." style="cursor: pointer; border-color: #BB9587;">
                <ul class="list-group position-absolute w-100" id="hasilPelanggan" style="z-index: 1000;"></ul>
            </div>

            <ul class="list-group mb-3" id="keranjangList"></ul>

            <div class="d-flex justify-content-between align-items-center mt-2">
                <strong style="color: #4E342E;">Total:</strong>
                <strong id="totalBayar" class="text-success">Rp 0</strong>
            </div>

            <div class="mb-3 mt-3">
                <label for="inputBayar" class="form-label text-muted">Uang Dibayarkan</label>
                <input type="number" class="form-control" id="inputBayar" placeholder="Masukkan jumlah uang" style="border-color: #BB9587;">
            </div>

            <button class="btn w-100 mt-3" onclick="submitPembayaran()" style="background-color: #6B8E23; color: white;">Bayar</button>
        </div>

        <!-- Modal Nota -->
        <div class="modal fade" id="notaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 380px;">
        <div class="modal-content p-4" id="modalNotaContent" style="background-color: #fefefe; font-family: monospace; font-size: 14px;">
            <div class="modal-header border-0 pb-1">
                <h5 class="modal-title w-100 text-center" style="font-weight: bold;">REMEN COFFEE</h5>
            </div>
            <div class="text-center mb-2" style="border-bottom: 1px dashed #999;">
                <small>Jl.Parangtiritis KM.11,Sabdodadi | 0877-2690-6687</small>
            </div>
            <div class="modal-body pt-0">
                <div class="mb-2">
                    <div><strong>Nama:</strong> <span id="modalNamaPelanggan"></span></div>
                    <div><strong>Tanggal:</strong> <span id="modalTanggal"></span></div>
                    <div><strong>No. Transaksi:</strong> <span id="modalNoTransaksi"></span></div>
                </div>

                <hr style="border-top: 1px dashed #999; margin: 8px 0;">

                <table class="w-100" style="font-size: 13px;">
                    <thead>
                        <tr>
                            <th align="left">Item</th>
                            <th align="center">Jml</th>
                            <th align="right">Harga</th>
                        </tr>
                    </thead>
                    <tbody id="modalDaftarBarang"></tbody>
                </table>

                <hr style="border-top: 1px dashed #999; margin: 8px 0;">

                <table class="w-100">
                    <tr>
                        <td align="left">Total</td>
                        <td align="right">Rp <span id="modalTotal"></span></td>
                    </tr>
                    <tr>
                        <td align="left">Bayar</td>
                        <td align="right">Rp <span id="modalBayar"></span></td>
                    </tr>
                    <tr>
                        <td align="left">Kembalian</td>
                        <td align="right">Rp <span id="modalKembalian"></span></td>
                    </tr>
                </table>

                <hr style="border-top: 1px dashed #999; margin: 8px 0;">

                <div class="text-center">
                    <p style="margin: 0;">Terima kasih!</p>
                    <p style="margin: 0;">~ Remen Coffee ~</p>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button class="btn btn-dark btn-sm" onclick="cetakModalSebagaiPDF()">Cetak Struk</button>
            </div>
        </div>
    </div>
</div>

    </div>
</div>


    <script>
        const selectedProduk = new Map();

        function selectProduk(id) {
            const el = document.querySelector(`[data-id='${id}']`);
            const nama = el.getAttribute('data-nama');
            const harga = el.getAttribute('data-harga')
            const imgEl = el.querySelector('img');
            const foto = imgEl ? imgEl.src : null;

            tambahProdukKeSementara(id, nama, harga, foto);
        }


        function hapusDariKeranjang(id) {
            selectedProduk.delete(id);
            const li = document.getElementById(`keranjang-item-${id}`);
            if (li) li.remove();
        }

        function tambahKeKeranjang() {
            if (selectedProduk.size === 0) {
                alert('Silakan pilih minimal satu produk.');
                return;
            }

            // Kirim data ke server jika ingin disimpan (contoh dummy console log)
            const selected = Array.from(selectedProduk.keys());
            console.log('Barang yang dibeli:', selected);

            alert('Produk berhasil ditambahkan!');
            // Reset keranjang
            selectedProduk.clear();
            document.getElementById('keranjangList').innerHTML = '';
        }

        // Fitur Pencarian
        document.getElementById('searchInput').addEventListener('input', function () {
            const keyword = this.value.toLowerCase();
            document.querySelectorAll('.produk-item').forEach(function (item) {
                const id = item.getAttribute('data-id');
                const nama = item.getAttribute('data-nama');
                const visible = id.includes(keyword) || nama.includes(keyword);
                item.style.display = visible ? '' : 'none';
            });
        });
    </script>
    <script>
    let keranjangSementara = [];

    function tambahProdukKeSementara(id, nama, harga, foto) {
        const index = keranjangSementara.findIndex(item => item.id === id);
        if (index > -1) {
            keranjangSementara[index].qty += 1;
        } else {
            keranjangSementara.push({ id, nama, harga, qty: 1, foto });
        }
        tampilkanKeranjang();
    }


    function tampilkanKeranjang() {
        const list = document.getElementById('keranjangList');
        list.innerHTML = '';

        let total = 0;

        keranjangSementara.forEach((item, index) => {
            const subtotal = item.qty * item.harga;
            total += subtotal;

            const li = document.createElement('li');
            li.className = 'list-group-item';

            li.innerHTML = `
                <div class="d-flex align-items-center justify-content-between">
                    <button class="btn btn-sm btn-danger me-2" onclick="hapusItem(${index})">×</button>

                    <img src="${item.foto || 'https://via.placeholder.com/50'}" alt="img" class="me-2" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">

                    <div class="flex-grow-1">
                        <div class="fw-bold">${item.nama}</div>
                        <small>Rp ${item.harga.toLocaleString()}</small>
                    </div>

                    <input type="number" min="1" value="${item.qty}" class="form-control form-control-sm mb-1"
                         onchange="updateQty(${index}, this.value)">
                    <div class="m-2"><strong>Rp ${subtotal.toLocaleString()}</strong></div>
                </div>
            `;

            list.appendChild(li);
        });

        document.getElementById('totalBayar').innerText = 'Rp ' + total.toLocaleString();
    }

    function updateQty(index, qty) {
        const jumlah = parseInt(qty);
        if (jumlah > 0) {
            keranjangSementara[index].qty = jumlah;
        }
        tampilkanKeranjang();
    }

    function hapusItem(index) {
        keranjangSementara.splice(index, 1);
        tampilkanKeranjang();
    }

    function submitPembayaran() {
        if (keranjangSementara.length === 0) {
            alert('Keranjang kosong!');
            return;
        }

        // Kirim via AJAX atau arahkan ke halaman bayar sesuai kebutuhan
        console.log('Checkout:', keranjangSementara);
        alert('Pembayaran diproses!');
    }
    </script>
    <script>
        const semuaPelanggan = @json($pelanggan);
    </script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const inputPelanggan = document.getElementById('inputPelanggan');
    const hasilPelanggan = document.getElementById('hasilPelanggan');
    const daftarPelanggan = semuaPelanggan;

    inputPelanggan.addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        hasilPelanggan.innerHTML = '';

        const cocok = daftarPelanggan.filter(p => p.nama.toLowerCase().includes(keyword));

        if (cocok.length === 0) {
            hasilPelanggan.innerHTML = `
                <li class="list-group-item text-center text-muted">Pelanggan tidak ditemukan</li>
            `;
        } else {
            cocok.forEach(p => {
                const item = document.createElement('li');
                item.className = 'list-group-item list-group-item-action';
                item.style.cursor = 'pointer';
                item.innerHTML = `<strong>${p.nama}</strong><br><small>${p.alamat || ''}</small>`;
                item.addEventListener('click', () => {
                    inputPelanggan.value = p.nama;
                    hasilPelanggan.innerHTML = '';
                });
                hasilPelanggan.appendChild(item);
            });
        }

        // Tambahkan tombol tambah pelanggan di bagian bawah
        const tambahBtn = document.createElement('li');
        tambahBtn.className = 'list-group-item text-center';
        tambahBtn.innerHTML = `<a href="{{ route('add_pel') }}" class="btn btn-sm btn-outline-primary w-100">+ Tambah Pelanggan Baru</a>`;
        hasilPelanggan.appendChild(tambahBtn);
    });

    inputPelanggan.addEventListener('focus', () => {
        inputPelanggan.dispatchEvent(new Event('input'));
    });

    document.addEventListener('click', function (e) {
        if (!inputPelanggan.contains(e.target) && !hasilPelanggan.contains(e.target)) {
            hasilPelanggan.innerHTML = '';
        }
    });
});
function tampilkanModalKonfirmasi(data) {
    document.getElementById('modalNamaPelanggan').textContent = data.nama_pelanggan;
    document.getElementById('modalTanggal').textContent = new Date().toLocaleDateString('id-ID');
    document.getElementById('modalNoTransaksi').textContent = data.id_penjualan || '-';

    document.getElementById('modalTotal').textContent = parseInt(data.total).toLocaleString();
    document.getElementById('modalBayar').textContent = parseInt(data.bayar).toLocaleString();
    document.getElementById('modalKembalian').textContent = parseInt(data.kembalian).toLocaleString();

    // Isi daftar barang
    const daftarBarang = document.getElementById('modalDaftarBarang');
    daftarBarang.innerHTML = ''; // Kosongkan

    data.barang?.forEach(item => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${item.nama}</td>
            <td class="text-center">${item.qty}</td>
            <td class="text-end">Rp ${parseInt(item.harga).toLocaleString()}</td>
            <td class="text-end">Rp ${(item.qty * item.harga).toLocaleString()}</td>
        `;
        daftarBarang.appendChild(tr);
    });

    const notaModal = new bootstrap.Modal(document.getElementById('notaModal'));
    notaModal.show();
}

function submitPembayaran() {
    const inputPelanggan = document.getElementById('inputPelanggan');
    const pelanggan = semuaPelanggan.find(p => p.nama === inputPelanggan.value);
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');

    if (!pelanggan) {
        alert('Pilih pelanggan terlebih dahulu!');
        return;
    }

    if (!csrfMeta) {
        alert('CSRF token tidak ditemukan di halaman.');
        return;
    }

    const csrfToken = csrfMeta.getAttribute('content');
    const bayar = parseInt(document.getElementById('inputBayar')?.value || 0);

    const totalText = document.getElementById('totalBayar').innerText;
    const totalClean = parseInt(totalText.replace(/[^\d]/g, '')) || 0;

    if (bayar < totalClean) {
        alert('Jumlah uang dibayarkan kurang dari total!');
        return;
    }

    const data = {
        id_pelanggan: pelanggan.id_pelanggan,
        bayar: bayar,
        total: totalClean,
        keranjang: keranjangSementara
    };

    fetch('/bayar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(data)
    })
    .then(async res => {
        const contentType = res.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            return res.json();
        } else {
            const text = await res.text();
            throw new Error('Respons bukan JSON: ' + text);
        }
    })
    .then(response => {
        if (response.success) {
            // Tambahkan informasi nama pelanggan, bayar, dan kembalian
            tampilkanModalKonfirmasi({
                ...response.data,
                nama_pelanggan: pelanggan.nama,
                bayar: bayar,
                kembalian: bayar - totalClean
            });

            // Reset keranjang dan input
            keranjangSementara = [];
            tampilkanKeranjang();
            document.getElementById('inputBayar').value = '';
            document.getElementById('inputPelanggan').value = '';
        } else {
            alert(response.message || 'Gagal melakukan pembayaran.');
        }
    })
    .catch(err => {
        console.error('Gagal fetch:', err.message);
        alert('Error detail: ' + err.message);
    });
}



function prosesPembayaranFinal() {
    const data = window.dataPembayaran;

    fetch('/kasir/selesai', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(response => {
        alert('Pembayaran berhasil!');
        keranjangSementara = [];
        tampilkanKeranjang();
        document.getElementById('inputBayar').value = '';
        document.getElementById('inputPelanggan').value = '';

        const modal = bootstrap.Modal.getInstance(document.getElementById('modalKonfirmasiBayar'));
        modal.hide();
    })
    .catch(err => {
        console.error(err);
        alert('Terjadi kesalahan saat menyimpan data.');
    });
}
</script>
<script>
function cetakModalSebagaiPDF() {
    const modalContent = document.getElementById('modalNotaContent');

    html2canvas(modalContent).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF();

        const imgProps = pdf.getImageProperties(imgData);
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

        pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
        pdf.save("nota-pembayaran.pdf");
    });
}
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
