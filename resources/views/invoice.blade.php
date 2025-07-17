@extends('kasir')
@section('invoice')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Modal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal">
        Show Invoice
    </button>
    <!-- Modal -->
    <div class="modal fade show" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true" style="display: block;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="invoiceModalLabel">Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h5 class="text-primary">Invoice To</h5>
                                <p>{{$invoiceData['id_pelanggan']}}</p>
                                <p>{{$invoiceData['nama_pelanggan']}}</p>
                            </div>
                            <div class="col-md-6 text-end">
                                <h5 class="text-primary">Invoice From</h5>
                                <p><strong>DToko</strong></p>
                                <p>dtoko.com</p>
                                <p>sabdodadi</p>
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="printInvoice()">Cetak Nota</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var invoiceModal = new bootstrap.Modal(document.getElementById('invoiceModal'));
            invoiceModal.show();
        });

        function printInvoice() {
            var modalContent = document.querySelector("#invoiceModal .modal-content").innerHTML;
            var printWindow = window.open("", "_blank");

            printWindow.document.write(`
                <html>
                    <head>
                        <title>Invoice</title>
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                        <style>
                            @media print {
                                .modal-footer { display: none; }
                            }
                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <div class="modal-content">${modalContent}</div>
                        </div>
                    </body>
                </html>
            `);

            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();

            // Pastikan modal tetap muncul setelah cetak
            var invoiceModal = new bootstrap.Modal(document.getElementById('invoiceModal'));
            invoiceModal.show();
        }
    </script>

</body>
@endsection
