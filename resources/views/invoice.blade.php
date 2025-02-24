@extends('kasir')
@section('invoice')


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Modal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</head>
<body>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal">
        View Invoice
    </button>

    <!-- Modal -->
    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="invoiceModalLabel">Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <h1 class="text-primary">DISEE</h1>
                            </div>
                            <div class="text-end">
                                <h2 class="text-primary">INVOICE</h2>
                                <p>Invoice Number: #</p>
                                <p>Invoice Date: </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h5 class="text-primary">Invoice To</h5>
                                <p><strong></strong></p>
                                <p></p>
                                <p></p>
                            </div>
                            <div class="col-md-6 text-end">
                                <h5 class="text-primary">Invoice From</h5>
                                <p><strong>ANIMAS ROKY</strong></p>
                                <p>Apexo Inc</p>
                                <p>billing@apexo.com</p>
                                <p>169 Teroghoria, Bangladesh</p>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>No.</th>
                                    <th>Item Description</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoiceData['items'] as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item['nama'] }}</td>
                                    <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                    <td>{{ $item['stok'] }}</td>
                                    <td>Rp {{ number_format($item['total'], 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end fw-bold">SubTotal</td>
                                    <td>Rp {{ number_format($invoiceData['total_harga'], 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end fw-bold">Pembayaran</td>
                                    <td>Rp {{ number_format($invoiceData['bayar'], 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end fw-bold text-primary">Kembalian</td>
                                    <td class="text-primary">Rp {{ number_format($invoiceData['kembalian'], 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h5 class="text-primary">Payment Method</h5>
                                <p>Account No: 00 123 647 840</p>
                                <p>Account Name: Jhon Doe</p>
                                <p>Branch Name: xyz</p>
                            </div>
                            <div class="col-md-6 text-end">
                                <h5 class="text-primary">Terms & Conditions</h5>
                                <p>Pembayaran tidak dapat dikembalikan setelah transaksi selesai.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Download PDF</button>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection
