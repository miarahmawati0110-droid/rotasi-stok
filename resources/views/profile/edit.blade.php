
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil Admin | Rotasi Stok Retail</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            background: #f1f5f9;
            color: #263445;
        }

        .container {
            max-width: 900px;
            margin: 45px auto;
            padding: 20px;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            color: #718096;
        }

        .card {
            background: white;
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 5px 25px rgba(0,0,0,.05);
        }

        .profile-top {
            display: flex;
            align-items: center;
            gap: 18px;
            padding-bottom: 25px;
            border-bottom: 1px solid #edf0f5;
            margin-bottom: 25px;
        }

        .avatar {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            background: #e5efff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
        }

        .profile-top h2 {
            font-size: 21px;
            margin-bottom: 6px;
        }

        .profile-top p {
            color: #718096;
            font-size: 14px;
        }

        .section-title {
            font-size: 17px;
            margin: 25px 0 18px;
            padding-bottom: 12px;
            border-bottom: 1px solid #edf0f5;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #dce3ec;
            border-radius: 9px;
            outline: none;
            font-size: 14px;
        }

        input:focus {
            border-color: #2875bd;
            box-shadow: 0 0 0 3px rgba(40,117,189,.1);
        }

        .info {
            color: #718096;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .success {
            padding: 14px;
            background: #e4f7eb;
            color: #237746;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        .error {
            color: #d33b3b;
            font-size: 13px;
            margin-top: 6px;
        }

        .buttons {
            display: flex;
            gap: 12px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 13px 22px;
            border: none;
            border-radius: 9px;
            text-decoration: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
        }

        .btn-save {
            background: #2875bd;
            color: white;
        }

        .btn-save:hover {
            background: #1c5e9c;
        }

        .btn-back {
            background: #e8edf3;
            color: #344054;
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
        <h1>Profil Admin</h1>
        <p>Kelola informasi akun administrator Rotasi Stok Retail.</p>
    </div>

    <div class="card">

        <div class="profile-top">
            <div class="avatar">👤</div>

            <div>
                <h2>{{ $user->name }}</h2>
                <p>Administrator Rotasi Stok Retail</p>
            </div>
        </div>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error" style="margin-bottom:20px;">
                Ada data yang belum benar. Silakan periksa kembali.
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <h3 class="section-title">Informasi Akun</h3>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    required
                >

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Username</label>
                <input
                    type="text"
                    name="username"
                    value="{{ old('username', $user->username) }}"
                    required
                >

                @error('username')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    required
                >

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <h3 class="section-title">Ganti Password</h3>

            <p class="info">
                Kosongkan kedua kolom password jika tidak ingin menggantinya.
            </p>

            <div class="form-group">
                <label>Password Baru</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password baru"
                    autocomplete="new-password"
                >

                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Ulangi password baru"
                    autocomplete="new-password"
                >
            </div>

            <div class="buttons">
                <button type="submit" class="btn btn-save">
                    💾 Simpan Perubahan
                </button>

                <a href="{{ route('dashboard') }}" class="btn btn-back">
                    ← Kembali
                </a>
            </div>

        </form>

    </div>
</div>

</body>
</html>
