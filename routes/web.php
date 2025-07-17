<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\produkController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\dashkasirController;
use App\Http\Controllers\kasirController;
use App\Http\Controllers\tableController;
use App\Http\Controllers\pelangganController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('/dashboard');
})->middleware('admin');

Route::get('/addUser', [UserController::class, 'addUser'])
    ->middleware('admin')
    ->name('addUser');
Route::post('/adduserr', [UserController::class, 'create'])->name('tambahuser')->middleware('admin');
Route::get('/edituser/{id}', [UserController::class, 'edit'])->name('edituser')->middleware('admin');
Route::put('/updateuser/{id}', [UserController::class, 'update'])->name('updateuser')->middleware('admin');
Route::get('/delete/{id}', [UserController::class, 'delete'])->name('deleteuser')->middleware('admin');

Route::get('/add_pelanggan', [pelangganController::class, 'create'])->name('add_pel')->middleware('kasir');
Route::post('/add_pelanggan', [pelangganController::class, 'index'])->name('aksi_pel')->middleware('kasir');

Route::get('/kasir', [kasirController::class, 'index'] )->name('cari_barang')->middleware('kasir');

Route::get('/kasir/barang', [kasirController::class, 'caribarang'] )->name('barang2')->middleware('kasir');
Route::get('/kasir/pelanggan', [kasirController::class, 'cariPelanggan'] )->name('pelanggan')->middleware('kasir');
Route::post('/tambahkeranjang', [kasirController::class, 'tambahkeranjang'] )->name('add')->middleware('kasir');
Route::post('/tambahpelanggan', [kasirController::class, 'tambahpelanggan'] )->name('add_pelanggan')->middleware('kasir');
Route::get('/kasir/add', [kasirController::class, 'viewCart'] )->name('cart')->middleware('kasir');
Route::post('/bayar', [kasirController::class, 'checkout'])->name('bayar');
Route::get('/kasir/viewpelanggan', [kasirController::class, 'viewPel'] )->name('vpel')->middleware('kasir');
Route::get('/invoice', [kasirController::class, 'invoice'])->name('invoice')->middleware('kasir');
Route::get('/resetkeranjang', [kasirController::class, 'resetkeranjang'])->name('resetkeranjang')->middleware('kasir');
Route::get('/kasir/hapus/{id}', [kasirController::class, 'hapusItem'])->name('hapusItem')->middleware('kasir');

Route::get('/tables', [tableController::class, 'topCustomers'] )->name('tables')->middleware('admin');


Route::get('/wallet', function () {
    return view('wallet');
})->name('wallet')->middleware('auth');

Route::get('/RTL', function () {
    return view('RTL');
})->name('RTL')->middleware('auth');

Route::get('/profile', function () {
    return view('account-pages.profile');
})->name('profile')->middleware('admin');

Route::get('/signin', function () {
    return view('account-pages.signin');
})->name('signin');

Route::get('/signup', function () {
    return view('account-pages.signup');
})->name('signup')->middleware('guest');

Route::get('/dashboard', [dashboardController::class, 'index'] )->name('dashboard')->middleware('admin');
Route::get('/dashboard/penjualan/show', [dashboardController::class, 'getPenjualan'])->name('get.penjualan')->middleware('admin');
Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard')->middleware('admin');
Route::get('/dashboard/penjualan', [dashboardController::class, 'index'])->name('penjualan')->middleware('admin');
Route::post('/filter', [dashboardController::class, 'filter'])->name('penjualan.filter')->middleware('admin');
Route::post('/dashboard/view/pdf', [dashboardController::class, 'print_laporan'])->name('print_laporan')->middleware('admin');

Route::get('/dashkasir', [dashkasirController::class, 'index'])->name('dashkasir')->middleware('kasir');
Route::get('/dashkasir/penjualan/show',[dashkasirController::class, 'getPenjualan'])->name('kasget.penjualan')->middleware('kasir');
Route::get('/dashkasir', [dashkasirController::class, 'index'])->name('dashkasir')->middleware('kasir');
Route::get('/dashkasir/penjualan', [dashkasirController::class, 'index'])->name('kaspenjualan')->middleware('kasir');
Route::get('/dashkasir/filter', [dashkasirController::class, 'filter'])->name('kaspenjualan.filter')->middleware('kasir');

Route::get('/sign-up', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('sign-up');

Route::post('/sign-up', [RegisterController::class, 'store'])
    ->middleware('guest');

Route::get('/sign-in', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('sign-in');

Route::post('/sign-in', [LoginController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/produk/{id}', [ProdukController::class, 'edit'])->name('editproduk');




Route::get('/add-produk', function(){
    return view('add-produk');
})->name('addproduk');

Route::post('/add-produk', [produkController::class, 'add'])->name('add-produk');

Route::put('/produk/{id_barang}', [ProdukController::class, 'update'])->name('update-produk');

Route::get('/delate/{id_barang}', [ProdukController::class, 'delete'])->name('delate-produk');

Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest');

Route::get('/laravel-examples/user-profile', [ProfileController::class, 'index'])->name('users.profile')->middleware('admin');
Route::put('/laravel-examples/user-profile/update', [ProfileController::class, 'update'])->name('users.update')->middleware('admin');;
Route::get('/laravel-examples/users-management', [UserController::class, 'index'])->name('users-management')->middleware('admin');;
Route::get('/laravel-examples/produk', [produkController::class, 'index'])->name('produk-management')->middleware('admin');;
