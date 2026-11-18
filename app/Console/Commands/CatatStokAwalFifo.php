<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\StokMasukDetail;

class CatatStokAwalFifo extends Command
{
    protected $signature = 'fifo:catat-stok-awal';

    protected $description = 'Mencatat stok barang yang sudah ada sebagai batch awal FIFO';

    public function handle()
    {
        $jumlahTercatat = 0;

        DB::transaction(function () use (&$jumlahTercatat) {

            $barangs = Barang::orderBy('id')
                ->lockForUpdate()
                ->get();

            foreach ($barangs as $barang) {

                // Lewati barang yang tidak memiliki stok
                if ($barang->stok <= 0) {
                    continue;
                }

                // Cek apakah barang sudah memiliki batch FIFO
                $sudahAda = StokMasukDetail::where(
                    'barang_id',
                    $barang->id
                )->exists();

                if ($sudahAda) {
                    continue;
                }

                // Buat transaksi khusus pencatatan stok awal
                $transaksi = Transaksi::create([
                    'barang_id' => $barang->id,
                    'jenis' => 'masuk',
                    'jumlah' => $barang->stok,
                    'harga' => $barang->harga_beli ?? 0,
                    'tanggal' => '2000-01-01',
                    'keterangan' => 'Pencatatan stok awal FIFO',
                ]);

                // Catat batch tanpa menambah stok barang
                StokMasukDetail::create([
                    'barang_id' => $barang->id,
                    'transaksi_id' => $transaksi->id,
                    'jumlah_masuk' => $barang->stok,
                    'sisa_stok' => $barang->stok,
                    'harga_beli' => $barang->harga_beli ?? 0,
                    'tanggal_masuk' => '2000-01-01',
                ]);

                $jumlahTercatat++;
            }
        });

        $this->info(
            "Berhasil mencatat {$jumlahTercatat} barang sebagai batch awal FIFO."
        );

        return self::SUCCESS;
    }
}
