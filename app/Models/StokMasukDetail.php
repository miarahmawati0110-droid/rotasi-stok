<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StokMasukDetail extends Model
{
    protected $table = 'stok_masuk_details';

    protected $fillable = [
        'barang_id',
        'transaksi_id',
        'jumlah_masuk',
        'sisa_stok',
        'harga_beli',
        'tanggal_masuk',
    ];

    protected $casts = [
        'jumlah_masuk' => 'integer',
        'sisa_stok' => 'integer',
        'harga_beli' => 'decimal:2',
        'tanggal_masuk' => 'date',
    ];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}
