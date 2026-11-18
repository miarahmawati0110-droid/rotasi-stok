<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang | Rotasi Stok</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
            background:
                linear-gradient(90deg,
                    rgba(239, 246, 255, .97) 0%,
                    rgba(239, 246, 255, .92) 38%,
                    rgba(239, 246, 255, .35) 68%,
                    rgba(10, 35, 65, .15) 100%),
                url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=2000&q=90');

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 1250px;
            margin: auto;
            padding: 55px;
            animation: fadeIn 1.2s ease;
        }

        .content {
            max-width: 650px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 55px;
            animation: slideDown 1s ease;
        }

        .brand-icon {
            width: 58px;
            height: 58px;
            background: linear-gradient(135deg, #398bd0, #124d91);
            border-radius: 16px;
            display: grid;
            place-items: center;
            font-size: 30px;
            box-shadow: 0 8px 20px rgba(23, 103, 165, .25);
        }

        .brand h2 {
            color: #102b50;
            font-size: 24px;
        }

        .brand p {
            color: #657c99;
            font-size: 12px;
            margin-top: 3px;
            letter-spacing: 1px;
        }

        .line {
            width: 65px;
            height: 4px;
            border-radius: 10px;
            background: #1767a5;
            margin-bottom: 25px;
        }

        .welcome-text {
            animation: slideUp 1.1s ease;
        }

        .welcome-text h1 {
            color: #102b50;
            font-size: clamp(36px, 5vw, 60px);
            line-height: 1.12;
            font-weight: 800;
            margin-bottom: 15px;
        }

        .welcome-text h1 span {
            display: block;
            color: #1767a5;
            font-size: clamp(43px, 6vw, 75px);
        }

        .welcome-text > p {
            color: #344e6c;
            font-size: 17px;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .btn-dashboard {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 17px 29px;
            border-radius: 50px;
            background: linear-gradient(110deg, #1767a5, #398bd0);
            color: white;
            font-size: 15px;
            font-weight: bold;
            text-decoration: none;
            box-shadow: 0 9px 22px rgba(23, 103, 165, .25);
            transition: .3s;
        }

        .btn-dashboard:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 28px rgba(23, 103, 165, .35);
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            margin-top: 45px;
            animation: fadeIn 1.8s ease;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-right: 22px;
            border-right: 1px solid rgba(16, 43, 80, .25);
        }

        .feature:last-child {
            border-right: none;
        }

        .feature-icon {
            font-size: 25px;
        }

        .feature p {
            color: #294768;
            font-size: 12px;
            line-height: 1.5;
            font-weight: 600;
        }

        .footer {
            margin-top: 65px;
            color: #71849b;
            font-size: 11px;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(35px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 700px) {
            body {
                background:
                    linear-gradient(rgba(239, 246, 255, .91),
                                    rgba(239, 246, 255, .88)),
                    url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1200&q=85');
                background-size: cover;
                background-position: center;
            }

            .container {
                padding: 35px 24px;
            }

            .brand {
                margin-bottom: 45px;
            }

            .welcome-text > p {
                font-size: 14px;
            }

            .features {
                gap: 17px;
                margin-top: 35px;
            }

            .feature {
                border-right: none;
                padding-right: 5px;
            }

            .footer {
                margin-top: 45px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="content">

        <div class="brand">
            <div class="brand-icon">📦</div>
            <div>
                <h2>Rotasi Stok</h2>
                <p>INVENTORY SYSTEM</p>
            </div>
        </div>

        <div class="welcome-text">

            <div class="line"></div>

            <h1>
                Selamat Datang di
                <span>Rotasi Stok</span>
            </h1>

            <p>
                Sistem Informasi Pengelolaan Stok dan Transaksi.
                Kelola persediaan barang dengan mudah, pantau
                pergerakan stok, dan tingkatkan efisiensi toko.
            </p>

            <a href="{{ route('dashboard') }}" class="btn-dashboard">
                <span>➜</span>
                Masuk Dashboard
                <span>→</span>
            </a>

        </div>

        <div class="features">

            <div class="feature">
                <span class="feature-icon">📦</span>
                <p>Kelola Stok<br>Dengan Mudah</p>
            </div>

            <div class="feature">
                <span class="feature-icon">📊</span>
                <p>Pantau Pergerakan<br>Barang</p>
            </div>

            <div class="feature">
                <span class="feature-icon">🛡️</span>
                <p>Tingkatkan<br>Efisiensi Bisnis</p>
            </div>

        </div>

        <div class="footer">
            © {{ date('Y') }} Rotasi Stok. All Rights Reserved.
        </div>

    </div>

</div>

</body>
</html>
