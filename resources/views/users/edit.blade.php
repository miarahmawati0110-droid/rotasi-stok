
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna - Rotasi Stok Retail</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            padding: 30px;
            background: #f4f6fb;
            color: #263247;
        }

        .container {
            max-width: 650px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,.06);
        }

        h2 {
            margin-top: 0;
            color: #243b64;
        }

        p {
            color: #718096;
        }

        label {
            display: block;
            margin: 17px 0 7px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #dce2ec;
            border-radius: 8px;
            outline: none;
        }

        input:focus {
            border-color: #3975d7;
        }

        .hint {
            font-size: 12px;
            color: #718096;
            margin-top: 6px;
        }

        .error {
            color: #c0392b;
            font-size: 13px;
            margin-top: 5px;
        }

        .success {
            background: #e2f7e9;
            color: #247542;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        button, .back {
            border: none;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            font-weight: bold;
        }

        button {
            background: #3975d7;
            color: white;
        }

        .back {
            background: #e9edf4;
            color: #344054;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>✏️ Edit Pengguna</h2>
    <p>Perbarui informasi akun pengguna.</p>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Lengkap</label>
        <input type="text" name="name"
               value="{{ old('name', $user->name) }}" required>

        <label>Username</label>
        <input type="text" name="username"
               value="{{ old('username', $user->username) }}" required>

        <label>Email</label>
        <input type="email" name="email"
               value="{{ old('email', $user->email) }}" required>

        <label>Password Baru</label>
        <input type="password" name="password">
        <div class="hint">Kosongkan jika tidak ingin mengganti password.</div>

        <label>Konfirmasi Password Baru</label>
        <input type="password" name="password_confirmation">

        <div class="buttons">
            <button type="submit">Simpan Perubahan</button>
            <a href="{{ route('users.index') }}" class="back">Kembali</a>
        </div>
    </form>

</div>

</body>
</html>
