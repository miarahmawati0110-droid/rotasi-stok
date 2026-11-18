
@extends('layouts.app')

@section('title', 'Edit Barang')
@section('heading', 'Edit Barang')

@section('content')

<style>
    .form-container {
        max-width: 700px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        margin-bottom: 7px;
        font-weight: bold;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 11px;
        border: 1px solid #ddd;
        border-radius: 6px;
    }

    .btn {
        padding: 11px 18px;
        border: none;
        border-radius: 6px;
        color: white;
        text-decoration: none;
        cursor: pointer;
        display: inline-block;
    }

    .btn-save {
        background: #3498db;
    }

    .btn-back {
        background: #777;
    }

    .error {
        color: #e74c3c;
        font-size: 13px;
        margin-top: 5px;
    }
</style>

<div class="form-container">

    <h3>Form Edit Barang</h3>
    <p>Silakan ubah informasi barang.</p>

    <br>

    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" name="kode_barang"
                   value="{{ old('kode_barang', $barang->kode_barang) }}" required>
            @error('kode_barang')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang"
                   value="{{ old('nama_barang', $barang->nama_barang) }}" required>
            @error('nama_barang')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori" required>
                @foreach (['Makanan', 'Minuman', 'Sembako', 'Kebutuhan Rumah', 'Lainnya'] as $kategori)
                    <option value="{{ $kategori }}"
                        @selected(old('kategori', $barang->kategori) == $kategori)>
                        {{ $kategori }}
                    </option>
                @endforeach
            </select>
            @error('kategori')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Satuan</label>
            <select name="satuan" required>
                @foreach (['pcs', 'kg', 'liter', 'dus', 'pak', 'botol', 'karung'] as $satuan)
                    <option value="{{ $satuan }}"
                        @selected(old('satuan', $barang->satuan) == $satuan)>
                        {{ $satuan }}
                    </option>
                @endforeach
            </select>
            @error('satuan')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Harga Beli</label>
            <input type="number" name="harga_beli"
                   value="{{ old('harga_beli', $barang->harga_beli) }}"
                   min="0" step="0.01" required>
            @error('harga_beli')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Harga Jual</label>
            <input type="number" name="harga_jual"
                   value="{{ old('harga_jual', $barang->harga_jual) }}"
                   min="0" step="0.01" required>
            @error('harga_jual')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok"
                   value="{{ old('stok', $barang->stok) }}"
                   min="0" required>
            @error('stok')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Stok Minimum</label>
            <input type="number" name="stok_minimum"
                   value="{{ old('stok_minimum', $barang->stok_minimum) }}"
                   min="0" required>
            @error('stok_minimum')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-save">
            Update Barang
        </button>

        <a href="{{ route('barang.index') }}" class="btn btn-back">
            Kembali
        </a>

    </form>

</div>

@endsection
