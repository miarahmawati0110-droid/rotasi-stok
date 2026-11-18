<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FifoController;
use App\Models\Barang;

// HALAMAN LOGIN
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::middleware('auth')->group(function () {

    // HALAMAN PEMBUKA SETELAH LOGIN
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');

    // DASHBOARD
    Route::get('/dashboard', function () {
        $totalBarang = Barang::count();

        $stokMenipis = Barang::whereColumn(
            'stok',
            '<=',
            'stok_minimum'
        )->count();

        $stokAman = Barang::whereColumn(
            'stok',
            '>',
            'stok_minimum'
        )->count();

        $totalKategori = Barang::distinct('kategori')
            ->count('kategori');

        $totalStok = Barang::sum('stok');

        $totalModal = Barang::selectRaw(
            'COALESCE(SUM(stok * harga_beli), 0) as total'
        )->value('total');

        $totalNilaiJual = Barang::selectRaw(
            'COALESCE(SUM(stok * harga_jual), 0) as total'
        )->value('total');

        $barangPerKategori = Barang::selectRaw(
            'kategori, SUM(stok) as total_stok'
        )
            ->groupBy('kategori')
            ->orderBy('kategori')
            ->get();

        return view('dashboard', compact(
            'totalBarang',
            'stokMenipis',
            'stokAman',
            'totalKategori',
            'totalStok',
            'totalModal',
            'totalNilaiJual',
            'barangPerKategori'
        ));
    })->name('dashboard');

    // HALAMAN FIFO
    Route::get('/fifo', [FifoController::class, 'index'])
        ->name('fifo.index');

    // DATA BARANG
    Route::resource('barang', BarangController::class)
        ->except(['show']);

    // BARANG MASUK
    Route::get('/barang-masuk', [TransaksiController::class, 'masuk'])
        ->name('barang-masuk.index');

    Route::post('/barang-masuk', [TransaksiController::class, 'store'])
        ->defaults('jenis', 'masuk')
        ->name('barang-masuk.store');

    // BARANG KELUAR
    Route::get('/barang-keluar', [TransaksiController::class, 'keluar'])
        ->name('barang-keluar.index');

    Route::post('/barang-keluar', [TransaksiController::class, 'store'])
        ->defaults('jenis', 'keluar')
        ->name('barang-keluar.store');

    // RIWAYAT TRANSAKSI
    Route::get('/riwayat-transaksi', [TransaksiController::class, 'riwayat'])
        ->name('transaksi.riwayat');

    // LAPORAN
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    // PROFIL
    Route::get('/profil', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profil', [ProfileController::class, 'update'])
        ->name('profile.update');

    // MANAJEMEN USER
    Route::resource('users', UserController::class)
        ->except(['show']);

    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});