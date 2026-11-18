<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\StokMasukDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransaksiController extends Controller
{
    // Halaman Barang Masuk
    public function masuk()
    {
        $transaksis = Transaksi::with('barang')
            ->where('jenis', 'masuk')
            ->latest()
            ->paginate(10);

        $barangs = Barang::orderBy('nama_barang')->get();

        return view('transaksi.masuk', compact('transaksis', 'barangs'));
    }

    // Halaman Barang Keluar
    public function keluar()
    {
        $transaksis = Transaksi::with('barang')
            ->where('jenis', 'keluar')
            ->latest()
            ->paginate(10);

        $barangs = Barang::orderBy('nama_barang')->get();

        return view('transaksi.keluar', compact('transaksis', 'barangs'));
    }

    // Menyimpan transaksi dengan sistem FIFO
    public function store(Request $request, string $jenis)
    {
        if (!in_array($jenis, ['masuk', 'keluar'])) {
            abort(404);
        }

        $validated = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'nullable|numeric|min:0',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        DB::transaction(function () use ($validated, $jenis) {

            // Mengunci data barang agar stok tidak bentrok
            $barang = Barang::whereKey($validated['barang_id'])
                ->lockForUpdate()
                ->firstOrFail();

            $jumlah = (int) $validated['jumlah'];

            // =========================
            // BARANG MASUK
            // =========================
            if ($jenis === 'masuk') {

                // Simpan transaksi masuk
                $transaksi = Transaksi::create([
                    'barang_id' => $barang->id,
                    'jenis' => 'masuk',
                    'jumlah' => $jumlah,
                    'harga' => $validated['harga'] ?? 0,
                    'tanggal' => $validated['tanggal'],
                    'keterangan' => $validated['keterangan'] ?? null,
                ]);

                // Tambahkan stok barang
                $barang->increment('stok', $jumlah);

                // Catat batch stok masuk FIFO
                StokMasukDetail::create([
                    'barang_id' => $barang->id,
                    'transaksi_id' => $transaksi->id,
                    'jumlah_masuk' => $jumlah,
                    'sisa_stok' => $jumlah,
                    'harga_beli' => $validated['harga'] ?? $barang->harga_beli ?? 0,
                    'tanggal_masuk' => $validated['tanggal'],
                ]);
            }

            // =========================
            // BARANG KELUAR
            // =========================
            else {

                // Periksa stok barang secara keseluruhan
                if ($barang->stok < $jumlah) {
                    throw ValidationException::withMessages([
                        'jumlah' => 'Stok tidak mencukupi. Stok tersedia: ' . $barang->stok,
                    ]);
                }

                // Ambil batch paling lama terlebih dahulu
                $batchList = StokMasukDetail::where('barang_id', $barang->id)
                    ->where('sisa_stok', '>', 0)
                    ->orderBy('tanggal_masuk', 'asc')
                    ->orderBy('id', 'asc')
                    ->lockForUpdate()
                    ->get();

                // Pastikan stok batch FIFO mencukupi
                $totalStokBatch = $batchList->sum('sisa_stok');

                if ($totalStokBatch < $jumlah) {
                    throw ValidationException::withMessages([
                        'jumlah' => 'Stok batch FIFO belum mencukupi. Sebagian stok lama belum memiliki catatan batch FIFO. Periksa dan catat stok awal terlebih dahulu.',
                    ]);
                }

                // Simpan transaksi keluar
                Transaksi::create([
                    'barang_id' => $barang->id,
                    'jenis' => 'keluar',
                    'jumlah' => $jumlah,
                    'harga' => $validated['harga'] ?? 0,
                    'tanggal' => $validated['tanggal'],
                    'keterangan' => $validated['keterangan'] ?? null,
                ]);

                // Kurangi batch tertua terlebih dahulu
                $sisaKeluar = $jumlah;

                foreach ($batchList as $batch) {

                    if ($sisaKeluar <= 0) {
                        break;
                    }

                    $jumlahDiBatch = (int) $batch->sisa_stok;

                    $jumlahDiambil = min(
                        $jumlahDiBatch,
                        $sisaKeluar
                    );

                    $batch->decrement('sisa_stok', $jumlahDiambil);

                    $sisaKeluar -= $jumlahDiambil;
                }

                // Perbarui stok keseluruhan barang
                $barang->decrement('stok', $jumlah);
            }
        });

        $pesan = $jenis === 'masuk'
            ? 'Barang masuk berhasil disimpan dan batch FIFO berhasil dicatat.'
            : 'Barang keluar berhasil disimpan menggunakan metode FIFO.';

        return redirect()
            ->route(
                $jenis === 'masuk'
                    ? 'barang-masuk.index'
                    : 'barang-keluar.index'
            )
            ->with('success', $pesan);
    }

    // Halaman Riwayat Transaksi
    public function riwayat(Request $request)
    {
        $query = Transaksi::with('barang');

        if (
            $request->filled('jenis') &&
            in_array($request->jenis, ['masuk', 'keluar'])
        ) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('keterangan', 'like', "%{$search}%")
                    ->orWhereHas('barang', function ($barangQuery) use ($search) {
                        $barangQuery
                            ->where('nama_barang', 'like', "%{$search}%")
                            ->orWhere('kode_barang', 'like', "%{$search}%");
                    });
            });
        }

        $transaksis = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('transaksi.riwayat', compact('transaksis'));
    }
}
