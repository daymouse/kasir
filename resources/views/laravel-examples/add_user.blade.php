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
        <div class="container-fluid px-5 py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="">Add USER</h5>
                            <p class="text-sm mb-0">tambah user</p>
                        </div>
                        <div class="card-body">
                            <form action="{{route('tambahuser')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="namabarang" class="form-label">Nama User</label>
                                    <input type="text" class="form-control" id="namabarang" name="namauser" placeholder="Enter product name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga_barang" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="harga_barang" name="email" placeholder="Enter product price" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="stok" name="passwordUser" placeholder="Enter product stock" required>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select name="role" class="form-control">
                                        <option value="#">Pilih Role</option>
                                        <option value="admin">admin</option>
                                        <option value="karyawan">karyawan</option>
                                    </select>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="" class="btn btn-secondary">Cancel</a>
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

<script src="/assets/js/plugins/datatables.js"></script>


</body>
</html>
