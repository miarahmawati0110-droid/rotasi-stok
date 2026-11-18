
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang - Rotasi Stok</title>

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

        .sidebar {
            position: fixed;
            width: 250px;
            height: 100vh;
            background: linear-gradient(180deg, #1d2b49, #17233d);
            padding: 25px 17px;
            color: white;
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
        }

        .main {
            margin-left: 250px;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 25px;
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
        }

        .content {
            background: white;
            padding: 28px;
            border-radius: 15px;
            box-shadow: 0 4px 18px rgba(36,48,80,.05);
            max-width: 850px;
        }

        .content h2 {
            font-size: 19px;
            margin-bottom: 8px;
        }

        .description {
            font-size: 13px;
            color: #929bb0;
            margin-bottom: 25px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #e0e5ef;
            border-radius: 8px;
            outline: none;
            background: white;
            font-size: 13px;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #526fe3;
        }

        .error {
            color: #dc4c62;
            font-size: 12px;
            margin-top: 6px;
        }

        .alert {
            background: #fff0f0;
            color: #c43d52;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 8px;
            background: linear-gradient(100deg, #526fe3, #7959cf);
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 13px;
        }

        .btn-cancel {
            background: #e9edf5;
            color: #596780;
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
                gap: 15px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .content {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">📦 ROTASI <span>STOK</span></div>

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

    <main class="main">

        <div class="header">
            <div>
                <h1>Tambah Barang</h1>
                <p>Tambahkan data persediaan barang baru</p>
            </div>

            <div class="admin">👤 Administrator</div>
        </div>

        <section class="content">

            <h2>📦 Form Tambah Barang</h2>
            <p class="description">
                Lengkapi informasi barang di bawah ini.
            </p>

            @if($errors->any())
                <div class="alert">
                    <strong>Periksa kembali data yang dimasukkan:</strong>
                    <ul style="margin:8px 0 0 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('barang.store') }}" method="POST">
                @csrf

                <div class="form-grid">

                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" name="kode_barang"
                               value="{{ old('kode_barang') }}"
                               placeholder="Contoh: BRG002" required>
                        @error('kode_barang')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang"
                               value="{{ old('nama_barang') }}"
                               placeholder="Masukkan nama barang" required>
                        @error('nama_barang')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" name="kategori"
                               value="{{ old('kategori') }}"
                               placeholder="Contoh: Sembako" required>
                        @error('kategori')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Satuan</label>
                        <select name="satuan" required>
                            <option value="">-- Pilih Satuan --</option>
                            @foreach(['pcs','kg','liter','dus','pak','botol','karung'] as $satuan)
                                <option value="{{ $satuan }}"
                                    {{ old('satuan') == $satuan ? 'selected' : '' }}>
                                    {{ ucfirst($satuan) }}
                                </option>
                            @endforeach
                        </select>
                        @error('satuan')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Harga Beli (Rp)</label>
                        <input type="number" name="harga_beli"
                               value="{{ old('harga_beli') }}"
                               min="0" placeholder="Contoh: 12000" required>
                        @error('harga_beli')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Harga Jual (Rp)</label>
                        <input type="number" name="harga_jual"
                               value="{{ old('harga_jual') }}"
                               min="0" placeholder="Contoh: 15000" required>
                        @error('harga_jual')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Stok Awal</label>
                        <input type="number" name="stok"
                               value="{{ old('stok', 0) }}"
                               min="0" placeholder="Masukkan jumlah stok" required>
                        @error('stok')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Stok Minimum</label>
                        <input type="number" name="stok_minimum"
                               value="{{ old('stok_minimum', 5) }}"
                               min="0" placeholder="Contoh: 5" required>
                        @error('stok_minimum')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="actions">
                    <button type="submit" class="btn">
                        💾 Simpan Barang
                    </button>

                    <a href="{{ route('barang.index') }}"
                       class="btn btn-cancel">
                        Kembali
                    </a>
                </div>

            </form>

        </section>

    </main>

</body>
</html>
