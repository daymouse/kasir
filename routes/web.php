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
use App\Http\Controllers\kasirController;


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

Route::get('/dashboard', [dashboardController::class, 'index'] )->name('dashboard')->middleware('admin');


Route::get('/kasir', function () {
    return view('kasir');
})->name('kasir')->middleware('auth');

Route::get('/kasir', [kasirController::class, 'cari'] )->name('cari_barang')->middleware('kasir');

Route::get('/kasir', [kasirController::class, 'index'] )->name('barang2')->middleware('kasir');
Route::get('/kasir/pelanggan', [kasirController::class, 'cariPelanggan'] )->name('pelanggan')->middleware('kasir');
Route::post('/kasir/keranjang',[kasirController::class, 'keranjang'] )->name('keranjang')->middleware('kasir');
Route::post('/tambahkeranjang', [kasirController::class, 'tambahkeranjang'] )->name('add')->middleware('kasir');
Route::get('/kasir/add', [kasirController::class, 'viewCart'] )->name('cart')->middleware('kasir');

Route::get('/tables', function () {
    return view('tables');
})->name('tables')->middleware('admin');

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

Route::get('/dashboard/penjualan', [dashboardController::class, 'index'])->name('penjualan');


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

Route::get('/laravel-examples/user-profile', [ProfileController::class, 'index'])->name('users.profile')->middleware('auth');
Route::put('/laravel-examples/user-profile/update', [ProfileController::class, 'update'])->name('users.update')->middleware('auth');
Route::get('/laravel-examples/users-management', [UserController::class, 'index'])->name('users-management')->middleware('auth');
Route::get('/laravel-examples/produk', [produkController::class, 'index'])->name('produk-management')->middleware('auth');
