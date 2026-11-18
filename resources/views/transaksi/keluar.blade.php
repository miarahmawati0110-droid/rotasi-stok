
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Keluar - ROTASI STOK</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            background: #f4f6fb;
            color: #263238;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #172554;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            padding: 25px 18px;
        }

        .logo {
            font-size: 23px;
            font-weight: bold;
            text-align: center;
            padding: 15px 0 35px;
        }

        .menu-title {
            font-size: 11px;
            color: #a5b4fc;
            margin: 18px 10px 12px;
            font-weight: bold;
        }

        .sidebar a {
            display: block;
            color: #dbeafe;
            text-decoration: none;
            padding: 13px 14px;
            margin-bottom: 7px;
            border-radius: 9px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2563eb;
            color: white;
        }

        .logout-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 9px;
            background: #dc2626;
            color: white;
            cursor: pointer;
            text-align: left;
            font-size: 14px;
        }

        .main {
            margin-left: 250px;
            padding: 30px;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            color: #172554;
            font-size: 27px;
        }

        .header p {
            color: #64748b;
            margin-top: 7px;
        }

        .panel {
            background: white;
            padding: 25px;
            border-radius: 14px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        }

        .panel h2 {
            font-size: 19px;
            color: #172554;
            margin-bottom: 20px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #475569;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #dbe2ea;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
            background: white;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #2563eb;
        }

        .full {
            grid-column: 1 / -1;
        }

        .btn-submit {
            background: #dc2626;
            color: white;
            border: none;
            padding: 13px 22px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-submit:hover {
            background: #b91c1c;
        }

        .alert {
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        th {
            background: #fff1f2;
            color: #9f1239;
            padding: 14px;
            text-align: left;
            font-size: 13px;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 13px;
        }

        .badge-keluar {
            background: #fee2e2;
            color: #b91c1c;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .empty {
            text-align: center;
            color: #94a3b8;
            padding: 25px;
        }

        .pagination {
            margin-top: 20px;
        }

        @media(max-width: 700px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main {
                margin-left: 0;
                padding: 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full {
                grid-column: auto;
            }
        }
    </style>
</head>

<body>

<aside class="sidebar">
    <div class="logo">📦 ROTASI STOK</div>

    <div class="menu-title">MENU UTAMA</div>

    <a href="{{ route('dashboard') }}"
       class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        🏠 Dashboard
    </a>

    <a href="{{ route('barang.index') }}"
       class="{{ request()->routeIs('barang.*') ? 'active' : '' }}">
        📦 Data Barang
    </a>

    <a href="{{ route('barang-masuk.index') }}"
       class="{{ request()->routeIs('barang-masuk.*') ? 'active' : '' }}">
        📥 Barang Masuk
    </a>

    <a href="{{ route('barang-keluar.index') }}"
       class="{{ request()->routeIs('barang-keluar.*') ? 'active' : '' }}">
        📤 Barang Keluar
    </a>

    <a href="{{ route('transaksi.riwayat') }}"
       class="{{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
        📋 Riwayat Transaksi
    </a>

    <div class="menu-title">AKUN</div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="logout-button" type="submit">🚪 Logout</button>
    </form>
</aside>


<main class="main">

    <div class="header">
        <h1>📤 Barang Keluar</h1>
        <p>Catat pengurangan stok barang dari persediaan toko.</p>
    </div>

    @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert error">
            <strong>Terjadi kesalahan:</strong>
            <ul style="margin: 8px 0 0 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="panel">
        <h2>➖ Form Tambah Barang Keluar</h2>

        <form action="{{ route('barang-keluar.store') }}" method="POST">
            @csrf

            <div class="form-grid">

                <div class="form-group full">
                    <label>Pilih Barang</label>

                    <select name="barang_id" required>
                        <option value="">-- Pilih Barang --</option>

                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}"
                                {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                {{ $barang->kode_barang }} - {{ $barang->nama_barang }}
                                (Stok: {{ $barang->stok }} {{ $barang->satuan }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Jumlah Barang Keluar</label>

                    <input type="number"
                           name="jumlah"
                           min="1"
                           value="{{ old('jumlah') }}"
                           placeholder="Masukkan jumlah barang"
                           required>
                </div>

                <div class="form-group">
                    <label>Harga per Satuan (Rp)</label>

                    <input type="number"
                           name="harga"
                           min="0"
                           step="0.01"
                           value="{{ old('harga') }}"
                           placeholder="Contoh: 15000">
                </div>

                <div class="form-group">
                    <label>Tanggal Keluar</label>

                    <input type="date"
                           name="tanggal"
                           value="{{ old('tanggal', date('Y-m-d')) }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Keterangan</label>

                    <input type="text"
                           name="keterangan"
                           value="{{ old('keterangan') }}"
                           placeholder="Contoh: Penjualan kepada pelanggan">
                </div>

                <div class="form-group full">
                    <button type="submit" class="btn-submit">
                        💾 Simpan Barang Keluar
                    </button>
                </div>

            </div>
        </form>
    </div>


    <div class="panel">
        <h2>📋 Riwayat Barang Keluar</h2>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($transaksis as $index => $transaksi)
                        <tr>
                            <td>{{ $transaksis->firstItem() + $index }}</td>

                            <td>
                                {{ $transaksi->tanggal->format('d-m-Y') }}
                            </td>

                            <td>
                                {{ $transaksi->barang->kode_barang ?? '-' }}
                            </td>

                            <td>
                                {{ $transaksi->barang->nama_barang ?? 'Barang dihapus' }}
                            </td>

                            <td>
                                {{ number_format($transaksi->jumlah) }}
                                {{ $transaksi->barang->satuan ?? '' }}
                            </td>

                            <td>
                                Rp {{ number_format($transaksi->harga, 0, ',', '.') }}
                            </td>

                            <td>{{ $transaksi->keterangan ?? '-' }}</td>

                            <td>
                                <span class="badge-keluar">Barang Keluar</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty">
                                Belum ada transaksi barang keluar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $transaksis->links() }}
        </div>
    </div>

</main>

</body>
</html>
