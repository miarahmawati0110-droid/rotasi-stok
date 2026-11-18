
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Rotasi Stok Retail')</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            background: #f3f6fc;
            color: #25344a;
        }

        /* SIDEBAR */
        .sidebar {
            width: 255px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #172b4d;
            color: white;
            padding: 25px 16px;
            overflow-y: auto;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 5px 8px 28px;
            border-bottom: 1px solid rgba(255,255,255,.12);
        }

        .logo-icon {
            width: 43px;
            height: 43px;
            background: #2478dc;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
        }

        .logo h2 {
            font-size: 17px;
            letter-spacing: .5px;
        }

        .logo small {
            color: #aabbd5;
            font-size: 11px;
        }

        .menu-title {
            color: #8fa4c3;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1.3px;
            margin: 26px 12px 12px;
            text-transform: uppercase;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 13px;
            color: #d5dfef;
            text-decoration: none;
            padding: 12px 14px;
            margin-bottom: 5px;
            border-radius: 9px;
            font-size: 13px;
            transition: .25s;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,.10);
            color: white;
            transform: translateX(3px);
        }

        .sidebar a.active {
            background: linear-gradient(135deg, #2688ef, #1765c0);
            color: white;
            box-shadow: 0 5px 14px rgba(22,105,205,.25);
        }

        .menu-icon {
            width: 21px;
            text-align: center;
            font-size: 17px;
        }

        .sidebar-footer {
            border-top: 1px solid rgba(255,255,255,.12);
            margin-top: 25px;
            padding-top: 15px;
        }

        .logout-button {
            display: flex;
            width: 100%;
            align-items: center;
            gap: 13px;
            background: transparent;
            color: #ffb8b8;
            border: none;
            padding: 12px 14px;
            border-radius: 9px;
            cursor: pointer;
            font-size: 13px;
            text-align: left;
        }

        .logout-button:hover {
            background: rgba(255,80,80,.13);
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 255px;
            padding: 25px 30px;
            min-height: 100vh;
        }

        /* TOPBAR */
        .topbar {
            background: white;
            padding: 17px 23px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 25px;
            box-shadow: 0 3px 15px rgba(30,55,90,.04);
            border: 1px solid #edf0f6;
        }

        .topbar h2 {
            font-size: 19px;
            color: #203653;
        }

        .topbar p {
            color: #8a98aa;
            font-size: 12px;
            margin-top: 4px;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e5efff;
            color: #216ac0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 16px;
        }

        .admin-name {
            font-size: 13px;
            font-weight: bold;
            color: #263b57;
        }

        .admin-role {
            font-size: 11px;
            color: #94a0b1;
            margin-top: 3px;
        }

        /* CONTENT */
        .content {
            background: white;
            padding: 25px;
            border-radius: 14px;
            min-height: 400px;
            border: 1px solid #edf0f6;
            box-shadow: 0 3px 15px rgba(30,55,90,.04);
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .sidebar {
                width: 215px;
            }

            .main-content {
                margin-left: 215px;
                padding: 18px;
            }
        }

        @media (max-width: 600px) {
            .sidebar {
                width: 70px;
                padding: 20px 9px;
            }

            .logo {
                justify-content: center;
                padding: 5px 0 20px;
            }

            .logo-text,
            .menu-title,
            .menu-label {
                display: none;
            }

            .sidebar a,
            .logout-button {
                justify-content: center;
                padding: 13px 5px;
            }

            .menu-icon {
                font-size: 20px;
            }

            .main-content {
                margin-left: 70px;
                padding: 12px;
            }

            .topbar {
                padding: 13px;
            }

            .topbar h2 {
                font-size: 15px;
            }

            .admin-name,
            .admin-role {
                display: none;
            }

            .content {
                padding: 15px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="logo">
            <div class="logo-icon">📦</div>

            <div class="logo-text">
                <h2>ROTASI STOK</h2>
                <small>Retail Inventory</small>
            </div>
        </div>

        <div class="menu-title">Menu Utama</div>

        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="menu-icon">🏠</span>
            <span class="menu-label">Dashboard</span>
        </a>

        <a href="{{ route('barang.index') }}"
           class="{{ request()->routeIs('barang.*') ? 'active' : '' }}">
            <span class="menu-icon">📦</span>
            <span class="menu-label">Data Barang</span>
        </a>

        <a href="{{ route('barang-masuk.index') }}"
           class="{{ request()->routeIs('barang-masuk.*') ? 'active' : '' }}">
            <span class="menu-icon">📥</span>
            <span class="menu-label">Barang Masuk</span>
        </a>

        <a href="{{ route('barang-keluar.index') }}"
           class="{{ request()->routeIs('barang-keluar.*') ? 'active' : '' }}">
            <span class="menu-icon">📤</span>
            <span class="menu-label">Barang Keluar</span>
        </a>

        <a href="{{ route('transaksi.riwayat') }}"
           class="{{ request()->routeIs('transaksi.riwayat') ? 'active' : '' }}">
            <span class="menu-icon">🔄</span>
            <span class="menu-label">Riwayat Transaksi</span>
        </a>

        <a href="{{ route('laporan.index') }}"
           class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">
            <span class="menu-icon">📊</span>
            <span class="menu-label">Laporan</span>
        </a>

        <div class="menu-title">Pengaturan Akun</div>

        <a href="{{ route('profile.edit') }}"
           class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <span class="menu-icon">👤</span>
            <span class="menu-label">Profil Admin</span>
        </a>

        <a href="{{ route('users.index') }}"
           class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
            <span class="menu-icon">👥</span>
            <span class="menu-label">Manajemen Pengguna</span>
        </a>

        <div class="sidebar-footer">

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-button">
                    <span class="menu-icon">🚪</span>
                    <span class="menu-label">Logout</span>
                </button>
            </form>

        </div>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="main-content">

        <header class="topbar">

            <div>
                <h2>@yield('heading', 'Dashboard')</h2>
                <p>Sistem Informasi Pengelolaan Stok Retail</p>
            </div>

            <div class="admin-info">

                <div class="admin-avatar">
                    👤
                </div>

                <div>
                    <div class="admin-name">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </div>

                    <div class="admin-role">
                        Administrator
                    </div>
                </div>

            </div>

        </header>


        <!-- ISI HALAMAN -->
        <section class="content">
            @yield('content')
        </section>

    </main>

</body>
</html>
