
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang - Rotasi Stok</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            background: #f3f5fb;
            color: #26314b;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            width: 250px;
            height: 100vh;
            background: linear-gradient(180deg, #1d2b49, #17233d);
            padding: 25px 17px;
            color: white;
            overflow-y: auto;
        }

        .brand {
            text-align: center;
            font-size: 21px;
            font-weight: bold;
            padding: 10px;
            margin-bottom: 35px;
        }

        .brand span {
            color: #8797ff;
        }

        .menu-title {
            color: #8f9db9;
            font-size: 11px;
            margin: 20px 10px 12px;
            letter-spacing: 1px;
        }

        .sidebar a {
            display: block;
            color: #cbd3e4;
            text-decoration: none;
            padding: 13px;
            border-radius: 9px;
            margin-bottom: 7px;
            font-size: 13px;
            transition: .2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: linear-gradient(100deg, #526fe3, #7959cf);
            color: white;
        }

        .sidebar form {
            margin-top: 30px;
        }

        .sidebar button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 9px;
            background: #bd5065;
            color: white;
            cursor: pointer;
            font-size: 13px;
        }

        /* MAIN */
        .main {
            margin-left: 250px;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 15px;
        }

        .header h1 {
            font-size: 25px;
            color: #26314b;
        }

        .header p {
            font-size: 13px;
            color: #929bb0;
            margin-top: 6px;
        }

        .admin {
            background: white;
            padding: 12px 17px;
            border-radius: 10px;
            font-size: 13px;
            box-shadow: 0 3px 12px rgba(36,48,80,.04);
        }

        /* SUMMARY */
        .summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 22px;
        }

        .summary-card {
            background: white;
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(36,48,80,.05);
        }

        .summary-card p {
            color: #929bb0;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .summary-card h2 {
            font-size: 24px;
            color: #26314b;
        }

        .summary-icon {
            font-size: 23px;
            margin-bottom: 12px;
        }

        /* CONTENT */
        .content {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 18px rgba(36,48,80,.05);
        }

        .content-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .content-top h2 {
            font-size: 18px;
        }

        .btn {
            display: inline-block;
            padding: 11px 17px;
            border-radius: 8px;
            background: linear-gradient(100deg, #526fe3, #7959cf);
            color: white;
            text-decoration: none;
            font-size: 13px;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            opacity: .9;
        }

        .search {
            display: flex;
            gap: 9px;
            margin-bottom: 20px;
        }

        .search input {
            width: 320px;
            max-width: 100%;
            padding: 11px 13px;
            border: 1px solid #e0e5ef;
            border-radius: 8px;
            outline: none;
        }

        .search input:focus {
            border-color: #526fe3;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th {
            background: #f2f4fb;
            color: #596780;
            padding: 14px 12px;
            text-align: left;
            font-size: 12px;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid #edf0f5;
            font-size: 13px;
        }

        tr:hover td {
            background: #fafbff;
        }

        .product {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .product-icon {
            width: 40px;
            height: 40px;
            background: #edf0ff;
            border-radius: 10px;
            display: grid;
            place-items: center;
            font-size: 21px;
        }

        .product strong {
            display: block;
            font-size: 13px;
        }

        .product small {
            color: #929bb0;
            font-size: 11px;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: #e8edff;
            color: #526fe3;
            font-size: 11px;
        }

        .safe {
            background: #e2f7ed;
            color: #21845d;
        }

        .low {
            background: #fff0df;
            color: #c77a31;
        }

        .action {
            display: flex;
            gap: 7px;
        }

        .edit {
            background: #526fe3;
            color: white;
            padding: 7px 10px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 11px;
        }

        .delete {
            background: #e35c70;
            color: white;
            border: none;
            padding: 7px 10px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 11px;
        }

        .alert {
            padding: 12px 15px;
            background: #e2f7ed;
            color: #21845d;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .pagination {
            margin-top: 20px;
        }

        @media(max-width: 900px) {
            .summary {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 700px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
                padding: 18px;
            }

            .header {
                align-items: flex-start;
                flex-direction: column;
            }

            .summary {
                grid-template-columns: 1fr;
            }

            .content {
                padding: 16px;
            }

            .search input {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            📦 ROTASI <span>STOK</span>
        </div>

        <div class="menu-title">MENU UTAMA</div>

        <a href="{{ route('dashboard') }}">🏠 Dashboard</a>

        <a href="{{ route('barang.index') }}"
           class="{{ request()->routeIs('barang.*') ? 'active' : '' }}">
            📦 Data Barang
        </a>

        <a href="{{ route('barang-masuk.index') }}">📥 Barang Masuk</a>

        <a href="{{ route('barang-keluar.index') }}">📤 Barang Keluar</a>

        <a href="{{ route('transaksi.riwayat') }}">📋 Riwayat Transaksi</a>

        <a href="{{ route('laporan.index') }}">📑 Laporan</a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">🚪 Logout</button>
        </form>

    </aside>

    <!-- MAIN -->
    <main class="main">

        <div class="header">
            <div>
                <h1>Data Barang</h1>
                <p>Kelola seluruh data persediaan barang toko</p>
            </div>

            <div class="admin">👤 Administrator</div>
        </div>

        <!-- RINGKASAN -->
        <div class="summary">

            <div class="summary-card">
                <div class="summary-icon">📦</div>
                <p>Total Jenis Barang</p>
                <h2>{{ $barangs->total() }}</h2>
            </div>

            <div class="summary-card">
                <div class="summary-icon">📊</div>
                <p>Total Stok Ditampilkan</p>
                <h2>{{ number_format($barangs->sum('stok')) }}</h2>
            </div>

            <div class="summary-card">
                <div class="summary-icon">⚠️</div>
                <p>Barang Menipis Ditampilkan</p>
                <h2>{{ $barangs->filter(fn($item) => $item->stok <= $item->stok_minimum)->count() }}</h2>
            </div>

        </div>

        <!-- DAFTAR BARANG -->
        <section class="content">

            <div class="content-top">
                <h2>📦 Daftar Barang</h2>

                <a href="{{ route('barang.create') }}" class="btn">
                    + Tambah Barang
                </a>
            </div>

            @if(session('success'))
                <div class="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('barang.index') }}" method="GET" class="search">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari kode atau nama barang..."
                    value="{{ request('search') }}"
                >

                <button type="submit" class="btn">Cari</button>
            </form>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Kode</th>
                            <th>Kategori</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($barangs as $index => $item)
                            <tr>
                                <td>{{ $barangs->firstItem() + $index }}</td>

                                <td>
                                    <div class="product">
                                        <div class="product-icon">
                                            @php
                                                $kategori = strtolower($item->kategori);
                                                $gambar = '📦';

                                                if (str_contains($kategori, 'sembako')) {
                                                    $gambar = '🌾';
                                                } elseif (str_contains($kategori, 'minuman')) {
                                                    $gambar = '🥤';
                                                } elseif (str_contains($kategori, 'makanan')) {
                                                    $gambar = '🍪';
                                                } elseif (str_contains($kategori, 'alat')) {
                                                    $gambar = '🧰';
                                                }
                                            @endphp

                                            {{ $gambar }}
                                        </div>

                                        <div>
                                            <strong>{{ $item->nama_barang }}</strong>
                                            <small>{{ $item->satuan }}</small>
                                        </div>
                                    </div>
                                </td>

                                <td>{{ $item->kode_barang }}</td>

                                <td>
                                    <span class="badge">
                                        {{ $item->kategori }}
                                    </span>
                                </td>

                                <td>
                                    Rp {{ number_format($item->harga_beli, 0, ',', '.') }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ number_format($item->stok) }} {{ $item->satuan }}
                                </td>

                                <td>
                                    @if($item->stok <= $item->stok_minimum)
                                        <span class="badge low">Stok Menipis</span>
                                    @else
                                        <span class="badge safe">Stok Aman</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="action">

                                        <a href="{{ route('barang.edit', $item->id) }}"
                                           class="edit">
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('barang.destroy', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus barang ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="delete">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="9" style="text-align:center;padding:30px;">
                                    Belum ada data barang.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $barangs->withQueryString()->links() }}
            </div>

        </section>

    </main>

</body>
</html>
