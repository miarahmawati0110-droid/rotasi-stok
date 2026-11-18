<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\StokMasukDetail;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jenis' => 'nullable|in:masuk,keluar',
        ]);

        // Data seluruh stok barang
        $barangs = Barang::orderBy('nama_barang')->get();

        // Query transaksi
        $query = Transaksi::with('barang');

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_selesai);
        }

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        $transaksis = $query
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->get();

        // Total barang masuk
        $totalMasuk = (clone $query)
            ->where('jenis', 'masuk')
            ->sum('jumlah');

        // Total barang keluar
        $totalKeluar = (clone $query)
            ->where('jenis', 'keluar')
            ->sum('jumlah');

        // Data batch FIFO yang masih memiliki stok
        $fifoDetails = StokMasukDetail::with('barang')
            ->where('sisa_stok', '>', 0)
            ->orderBy('tanggal_masuk')
            ->orderBy('id')
            ->get();

        // Total sisa stok seluruh batch FIFO
        $totalStokFifo = $fifoDetails->sum('sisa_stok');

        // Total nilai persediaan berdasarkan harga beli batch
        $totalNilaiFifo = $fifoDetails->sum(function ($detail) {
            return $detail->sisa_stok * $detail->harga_beli;
        });

        return view('laporan.index', compact(
            'barangs',
            'transaksis',
            'totalMasuk',
            'totalKeluar',
            'fifoDetails',
            'totalStokFifo',
            'totalNilaiFifo'
        ));
    }
}
