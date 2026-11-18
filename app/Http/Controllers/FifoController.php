<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokMasukDetail;
use Illuminate\Http\Request;

class FifoController extends Controller
{
    public function index(Request $request)
    {
        $query = StokMasukDetail::with('barang');

        if ($request->filled('barang_id')) {
            $query->where('barang_id', $request->barang_id);
        }

        if ($request->filled('tanggal_awal')) {
            $query->whereDate('tanggal_masuk', '>=', $request->tanggal_awal);
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tanggal_masuk', '<=', $request->tanggal_akhir);
        }

        $totalSisa = (clone $query)->sum('sisa_stok');

        $details = $query
            ->orderBy('tanggal_masuk')
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();

        $barangs = Barang::orderBy('nama_barang')->get();

        return view('fifo.index', compact(
            'details',
            'barangs',
            'totalSisa'
        ));
    }
}
