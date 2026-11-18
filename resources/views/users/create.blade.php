
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna | Rotasi Stok Retail</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            background: #f3f6fa;
            color: #263445;
        }

        .container {
            max-width: 750px;
            margin: 40px auto;
            padding: 20px;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 27px;
            margin-bottom: 8px;
        }

        .header p {
            color: #718096;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,.05);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #dce3ec;
            border-radius: 8px;
            outline: none;
        }

        input:focus {
            border-color: #2875bd;
        }

        .error {
            color: #d33b3b;
            font-size: 13px;
            margin-top: 6px;
        }

        .info {
            background: #edf5ff;
            color: #3566a0;
            padding: 13px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 22px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            padding: 13px 20px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
        }

        .btn-save {
            background: #2875bd;
            color: white;
        }

        .btn-back {
            background: #e9edf3;
            color: #39465a;
        }

        @media(max-width: 600px) {
            .container {
                margin: 15px auto;
            }

            .card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Tambah Pengguna</h1>
        <p>Tambahkan akun pengguna baru ke sistem.</p>
    </div>

    <div class="card">

        <div class="info">
            Lengkapi seluruh informasi di bawah untuk membuat akun pengguna baru.
        </div>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Masukkan nama lengkap"
                       required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Username</label>
                <input type="text"
                       name="username"
                       value="{{ old('username') }}"
                       placeholder="Masukkan username"
                       required>
                @error('username')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="Masukkan email"
                       required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password"
                       name="password"
                       placeholder="Minimal 8 karakter"
                       required
                       autocomplete="new-password">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password"
                       name="password_confirmation"
                       placeholder="Ulangi password"
                       required
                       autocomplete="new-password">
            </div>

            <div class="buttons">
                <button type="submit" class="btn btn-save">
                    Simpan Pengguna
                </button>

                <a href="{{ route('users.index') }}" class="btn btn-back">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>
