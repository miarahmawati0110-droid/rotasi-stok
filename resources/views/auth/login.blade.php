
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rotasi Stok</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px;

            background:
                linear-gradient(rgba(5, 20, 45, 0.55), rgba(5, 20, 45, 0.65)),
                url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=2000&q=85');

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .login-container {
            width: 100%;
            max-width: 430px;
            background: rgba(255, 255, 255, 0.96);
            padding: 38px;
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: muncul 0.7s ease;
        }

        @keyframes muncul {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .brand {
            text-align: center;
            margin-bottom: 25px;
        }

        .icon-box {
            width: 75px;
            height: 75px;
            background: linear-gradient(135deg, #dcecff, #b9d8ff);
            color: #0755ad;
            border-radius: 22px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 15px;
            font-size: 38px;
        }

        .brand h2 {
            color: #102b50;
            font-size: 25px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .brand p {
            color: #64748b;
            font-size: 13px;
            margin-top: 6px;
        }

        .login-title {
            text-align: center;
            color: #16365f;
            font-size: 23px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 19px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #263e5b;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 15px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            outline: none;
            font-size: 14px;
            background: #f8fafc;
            transition: 0.3s;
        }

        .form-group input:focus {
            border-color: #1673d1;
            background: white;
            box-shadow: 0 0 0 3px rgba(22,115,209,0.12);
        }

        .error-message {
            background: #fee2e2;
            color: #b91c1c;
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 9px;
            font-size: 13px;
        }

        .success-message {
            background: #dcfce7;
            color: #15803d;
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 9px;
            font-size: 13px;
        }

        .login-button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #1673d1, #084b9b);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 5px 15px rgba(8,75,155,0.25);
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(8,75,155,0.35);
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            color: #718096;
            font-size: 12px;
            line-height: 1.7;
        }

        @media(max-width: 450px) {
            body {
                padding: 15px;
            }

            .login-container {
                padding: 27px 22px;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">

        <div class="brand">
            <div class="icon-box">📦</div>
            <h2>ROTASI STOK</h2>
            <p>Sistem Informasi Pengelolaan Stok Barang</p>
        </div>

        <h2 class="login-title">Login Sistem</h2>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Masukkan username"
                    value="{{ old('username') }}"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <button type="submit" class="login-button">
                LOGIN
            </button>
        </form>

        <div class="footer">
            &copy; 2026 Sistem Rotasi Stok Otomatis
            <br>
            Toko Retail
        </div>

    </div>

</body>
</html>
