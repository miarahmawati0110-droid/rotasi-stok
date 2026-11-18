
<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Rotasi Stok</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --bg: #f5f6fc;
            --surface: #ffffff;
            --surface-soft: #f1efff;
            --text: #252642;
            --muted: #85869f;
            --border: #ececf5;
            --primary: #7965dc;
            --sidebar: #211e3c;
            --shadow: 0 8px 28px rgba(40, 35, 80, .06);
        }

        [data-theme="dark"] {
            --bg: #111322;
            --surface: #1c2033;
            --surface-soft: #292541;
            --text: #f4f3ff;
            --muted: #a5a7c0;
            --border: #30344a;
            --primary: #a995ff;
            --sidebar: #17182b;
            --shadow: 0 8px 28px rgba(0, 0, 0, .18);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            transition: background .3s, color .3s;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .sidebar {
            position: fixed;
            width: 250px;
            height: 100vh;
            background: var(--sidebar);
            color: white;
            padding: 25px 17px;
            display: flex;
            flex-direction: column;
            z-index: 10;
            overflow-y: auto;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 5px 10px 30px;
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            border-radius: 14px;
            background: linear-gradient(135deg, #9c83ff, #5d80ed);
            display: grid;
            place-items: center;
            font-size: 23px;
        }

        .brand h2 { font-size: 19px; }
        .brand small { color: #aaa8c5; font-size: 11px; }

        .menu-label {
            color: #8886a8;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1.5px;
            padding: 13px 12px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 12px 14px;
            margin-bottom: 6px;
            border-radius: 11px;
            color: #c5c3dc;
            font-size: 13px;
            transition: .25s;
        }

        .menu a:hover,
        .menu a.active {
            background: linear-gradient(100deg, #7865dc, #6556bd);
            color: white;
            box-shadow: 0 5px 15px rgba(120, 101, 220, .25);
        }

        .menu-icon {
            width: 21px;
            text-align: center;
            font-size: 17px;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 20px;
        }

        .main {
            margin-left: 250px;
            padding: 28px 32px;
            min-height: 100vh;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 27px;
        }

        .topbar h1 {
            font-size: 25px;
            font-weight: 750;
        }

        .topbar p {
            color: var(--muted);
            font-size: 13px;
            margin-top: 5px;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .theme-btn,
        .notification-btn {
            width: 43px;
            height: 43px;
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--text);
            border-radius: 13px;
            cursor: pointer;
            font-size: 19px;
            position: relative;
            transition: .25s;
        }

        .theme-btn:hover,
        .notification-btn:hover {
            transform: translateY(-3px);
            border-color: var(--primary);
        }

        .notification-dot {
            position: absolute;
            width: 9px;
            height: 9px;
            background: #ff5d75;
            border: 2px solid var(--surface);
            border-radius: 50%;
            top: 8px;
            right: 8px;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--surface);
            padding: 6px 12px 6px 7px;
            border-radius: 13px;
            border: 1px solid var(--border);
        }

        .avatar {
            width: 34px;
            height: 34px;
            border-radius: 11px;
            background: linear-gradient(135deg, #a88af8, #6b83e8);
            color: white;
            display: grid;
            place-items: center;
            font-weight: bold;
        }

        .profile strong {
            display: block;
            font-size: 12px;
        }

        .profile small {
            color: var(--muted);
            font-size: 10px;
        }

        .welcome {
            background: linear-gradient(110deg, #7563d8, #8e73e9 55%, #638ce8);
            color: white;
            border-radius: 20px;
            padding: 27px 30px;
            margin-bottom: 23px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 12px 28px rgba(111, 94, 207, .2);
        }

        .welcome::after {
            content: "";
            position: absolute;
            width: 210px;
            height: 210px;
            border: 35px solid rgba(255,255,255,.09);
            border-radius: 50%;
            right: 45px;
            top: -105px;
        }

        .welcome h2 {
            font-size: 23px;
            margin-bottom: 8px;
        }

        .welcome p {
            font-size: 13px;
            color: #eeeaff;
            max-width: 550px;
            line-height: 1.7;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 17px;
            margin-bottom: 22px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 17px;
            padding: 19px;
            box-shadow: var(--shadow);
            transition: .25s;
        }

        .stat-card:hover { transform: translateY(-5px); }

        .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            font-size: 21px;
        }

        .purple { background: #eee9ff; color: #8065db; }
        .blue { background: #e4f0ff; color: #4f91e8; }
        .green { background: #e0f7ed; color: #29a879; }
        .orange { background: #fff0df; color: #ed9b42; }
        .pink { background: #ffe7f0; color: #df6e9d; }

        [data-theme="dark"] .purple { background: #393052; color: #c1aaff; }
        [data-theme="dark"] .blue { background: #253b56; color: #8dc1ff; }
        [data-theme="dark"] .green { background: #204439; color: #73e2b5; }
        [data-theme="dark"] .orange { background: #4b3828; color: #ffc27f; }
        [data-theme="dark"] .pink { background: #4b2e43; color: #ffacd0; }

        .stat-card h3 {
            font-size: 26px;
            margin: 17px 0 4px;
        }

        .stat-card p {
            color: var(--muted);
            font-size: 12px;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 25px 0 14px;
        }

        .section-heading h3 { font-size: 16px; }
        .section-heading span { color: var(--muted); font-size: 11px; }

        .charts-grid {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 17px;
        }

        .chart-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 17px;
            padding: 20px;
            box-shadow: var(--shadow);
            min-width: 0;
        }

        .chart-card h3 {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .chart-card p {
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 17px;
        }

        .chart-container {
            position: relative;
            height: 260px;
            width: 100%;
        }

        .chart-container.small { height: 230px; }

        .bottom-grid {
            display: grid;
            grid-template-columns: 1.25fr 1fr;
            gap: 17px;
            margin-top: 18px;
        }

        .notice-card,
        .fifo-card {
            border-radius: 17px;
            padding: 21px;
            border: 1px solid var(--border);
            background: var(--surface);
            box-shadow: var(--shadow);
        }

        .notice-title,
        .fifo-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .notice-title h3,
        .fifo-title h3 { font-size: 14px; }

        .notice-count {
            margin-left: auto;
            background: #ffe5eb;
            color: #d94d6c;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        [data-theme="dark"] .notice-count {
            background: #512c3b;
            color: #ff9bb2;
        }

        .notice-message {
            display: flex;
            gap: 12px;
            padding: 13px;
            background: var(--surface-soft);
            border-radius: 12px;
            align-items: flex-start;
        }

        .notice-message .bell { font-size: 20px; }
        .notice-message strong { font-size: 12px; }

        .notice-message p {
            font-size: 11px;
            color: var(--muted);
            margin-top: 5px;
            line-height: 1.6;
        }

        .notice-link {
            display: inline-block;
            margin-top: 13px;
            color: var(--primary);
            font-size: 12px;
            font-weight: bold;
        }

        /* KARTU FIFO YANG BISA DIKLIK */
        .fifo-card {
            display: block;
            background: linear-gradient(135deg, #e9fff5, #e8f1ff);
            border: none;
            color: #285c50;
            text-decoration: none;
            cursor: pointer;
            transition: .3s ease;
        }

        .fifo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(40, 35, 80, .13);
        }

        [data-theme="dark"] .fifo-card {
            background: linear-gradient(135deg, #203b38, #25304b);
            color: #d4f8eb;
        }

        .fifo-title .fifo-icon {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            display: grid;
            place-items: center;
            background: rgba(255,255,255,.65);
            font-size: 21px;
        }

        [data-theme="dark"] .fifo-title .fifo-icon {
            background: rgba(255,255,255,.09);
        }

        .fifo-card p {
            font-size: 12px;
            line-height: 1.8;
            opacity: .85;
        }

        .fifo-status {
            display: inline-block;
            margin-top: 13px;
            padding: 6px 11px;
            background: rgba(44, 160, 111, .13);
            color: #25845e;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
        }

        [data-theme="dark"] .fifo-status { color: #83edbf; }

        .money-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 17px;
            margin-top: 18px;
        }

        .money-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 19px;
            box-shadow: var(--shadow);
        }

        .money-card p { font-size: 12px; color: var(--muted); }
        .money-card h3 { font-size: 21px; margin-top: 10px; }
        .money-card:first-child h3 { color: #4e91df; }
        .money-card:last-child h3 { color: #27aa7d; }

        .logout-form { margin-top: 10px; }

        .logout-form button {
            width: 100%;
            border: 0;
            cursor: pointer;
            background: transparent;
            color: #ffabb7;
            text-align: left;
            padding: 12px 14px;
            border-radius: 11px;
            font-size: 13px;
        }

        .logout-form button:hover { background: rgba(255,255,255,.1); }

        @media (max-width: 1100px) {
            .stats { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 850px) {
            .sidebar { width: 75px; padding: 20px 10px; }
            .brand { justify-content: center; padding: 5px 0 25px; }
            .brand-text, .menu-label, .menu-text { display: none; }
            .menu a { justify-content: center; padding: 13px 5px; }
            .menu-icon { font-size: 20px; }
            .main { margin-left: 75px; padding: 22px 18px; }
        }

        @media (max-width: 650px) {
            .main { padding: 18px 12px; }
            .topbar { align-items: flex-start; }
            .topbar h1 { font-size: 20px; }
            .profile .profile-text { display: none; }

            .charts-grid,
            .bottom-grid,
            .money-grid { grid-template-columns: 1fr; }

            .stats { gap: 10px; }
            .stat-card { padding: 14px; }
            .stat-card h3 { font-size: 22px; }
            .welcome { padding: 22px; }
            .chart-container { height: 230px; }
        }
    </style>
</head>

<body>

@php
    $kategoriLabels = $barangPerKategori->pluck('kategori')->map(fn($v) => $v ?: 'Tanpa Kategori')->values();
    $kategoriStok = $barangPerKategori->pluck('total_stok')->map(fn($v) => (int) $v)->values();
@endphp

<aside class="sidebar">
    <div class="brand">
        <div class="brand-icon">📦</div>
        <div class="brand-text">
            <h2>Rotasi Stok</h2>
            <small>Inventory System</small>
        </div>
    </div>

    <div class="menu-label">MENU UTAMA</div>

    <nav class="menu">
        <a href="{{ route('dashboard') }}" class="active">
            <span class="menu-icon">▦</span>
            <span class="menu-text">Dashboard</span>
        </a>

        <a href="{{ route('barang.index') }}">
            <span class="menu-icon">📦</span>
            <span class="menu-text">Data Barang</span>
        </a>

        <a href="{{ route('barang-masuk.index') }}">
            <span class="menu-icon">📥</span>
            <span class="menu-text">Barang Masuk</span>
        </a>

        <a href="{{ route('barang-keluar.index') }}">
            <span class="menu-icon">📤</span>
            <span class="menu-text">Barang Keluar</span>
        </a>

        <a href="{{ route('transaksi.riwayat') }}">
            <span class="menu-icon">📋</span>
            <span class="menu-text">Riwayat Transaksi</span>
        </a>

        <a href="{{ route('laporan.index') }}">
            <span class="menu-icon">📊</span>
            <span class="menu-text">Laporan</span>
        </a>
    </nav>

    <div class="sidebar-bottom">
        <div class="menu-label">AKUN</div>

        <nav class="menu">
            <a href="{{ route('profile.edit') }}">
                <span class="menu-icon">👤</span>
                <span class="menu-text">Profil Admin</span>
            </a>

            <a href="{{ route('users.index') }}">
                <span class="menu-icon">👥</span>
                <span class="menu-text">Manajemen Pengguna</span>
            </a>
        </nav>

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit">
                <span class="menu-icon">↪</span>
                <span class="menu-text">Keluar</span>
            </button>
        </form>
    </div>
</aside>

<main class="main">

    <header class="topbar">
        <div>
            <h1>Dashboard Analytics</h1>
            <p>Ringkasan dan pemantauan persediaan toko.</p>
        </div>

        <div class="top-actions">
            <button class="theme-btn" id="themeToggle"
                    type="button" title="Ganti tema">
                ☀️
            </button>

            <a href="{{ route('barang.index') }}"
               class="notification-btn"
               title="Lihat stok barang">
                🔔
                @if($stokMenipis > 0)
                    <span class="notification-dot"></span>
                @endif
            </a>

            <div class="profile">
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="profile-text">
                    <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
                    <small>Administrator</small>
                </div>
            </div>
        </div>
    </header>

    <section class="welcome">
        <h2>Selamat Datang, {{ auth()->user()->name ?? 'Admin' }}! 👋</h2>
        <p>
            Kelola persediaan toko dengan lebih mudah.
            Pantau stok, transaksi, dan pergerakan barang melalui
            dashboard Rotasi Stok.
        </p>
    </section>

    <section class="stats">
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon purple">📦</div>
            </div>
            <h3>{{ number_format($totalBarang ?? 0, 0, ',', '.') }}</h3>
            <p>Total Jenis Barang</p>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon blue">🗃️</div>
            </div>
            <h3>{{ number_format($totalStok ?? 0, 0, ',', '.') }}</h3>
            <p>Total Stok Barang</p>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon green">✅</div>
            </div>
            <h3>{{ number_format($stokAman ?? 0, 0, ',', '.') }}</h3>
            <p>Barang dengan Stok Aman</p>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon orange">⚠️</div>
            </div>
            <h3>{{ number_format($stokMenipis ?? 0, 0, ',', '.') }}</h3>
            <p>Barang dengan Stok Menipis</p>
        </div>
    </section>

    <div class="section-heading">
        <h3>📈 Analisis Persediaan</h3>
        <span>Data berdasarkan database</span>
    </div>

    <section class="charts-grid">
        <div class="chart-card">
            <h3>Pergerakan Stok per Kategori</h3>
            <p>Grafik garis dengan animasi saat dashboard dibuka.</p>
            <div class="chart-container">
                <canvas id="lineChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <h3>Status Persediaan</h3>
            <p>Perbandingan stok aman dan stok menipis.</p>
            <div class="chart-container small">
                <canvas id="doughnutChart"></canvas>
            </div>
        </div>
    </section>

    <section class="charts-grid" style="margin-top:17px;">
        <div class="chart-card">
            <h3>Jumlah Stok per Kategori</h3>
            <p>Perbandingan jumlah stok setiap kategori barang.</p>
            <div class="chart-container">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <h3>Ringkasan Kategori</h3>
            <p>Jumlah stok yang tersimpan pada setiap kategori.</p>
            <div class="chart-container">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </section>

    <div class="section-heading">
        <h3>🔔 Informasi dan Sistem</h3>
        <span>Pemberitahuan persediaan</span>
    </div>

    <section class="bottom-grid">
        <div class="notice-card">
            <div class="notice-title">
                <span style="font-size:22px;">🔔</span>
                <h3>Notifikasi Stok</h3>

                <span class="notice-count">
                    {{ $stokMenipis ?? 0 }} Peringatan
                </span>
            </div>

            <div class="notice-message">
                <span class="bell">⚠️</span>
                <div>
                    @if(($stokMenipis ?? 0) > 0)
                        <strong>Ada barang yang stoknya menipis!</strong>
                        <p>
                            Terdapat {{ $stokMenipis }} jenis barang
                            dengan stok mencapai atau berada di bawah
                            batas minimum. Periksa data barang.
                        </p>
                    @else
                        <strong>Persediaan dalam kondisi aman.</strong>
                        <p>
                            Belum ada barang yang terdeteksi mencapai
                            batas minimum stok.
                        </p>
                    @endif
                </div>
            </div>

            <a href="{{ route('barang.index') }}" class="notice-link">
                Periksa data barang →
            </a>
        </div>

        <!-- KARTU FIFO SEKARANG BISA DIKLIK -->
        <a href="/fifo" class="fifo-card">
            <div class="fifo-title">
                <div class="fifo-icon">🔄</div>
                <div>
                    <h3>Sistem Rotasi Stok FIFO</h3>
                    <small>First In, First Out</small>
                </div>
            </div>

            <p>
                FIFO adalah metode pengelolaan persediaan yang
                memprioritaskan barang yang masuk lebih dahulu
                untuk dikeluarkan lebih dahulu.
            </p>

            <p style="margin-top:9px;">
                Metode ini membantu menjaga urutan rotasi stok
                dan mengurangi risiko barang terlalu lama tersimpan.
            </p>

            <span class="fifo-status">
                ✓ Lihat Detail FIFO →
            </span>
        </a>
    </section>

    <section class="money-grid">
        <div class="money-card">
            <p>💰 Total Nilai Modal Persediaan</p>
            <h3>Rp {{ number_format($totalModal ?? 0, 0, ',', '.') }}</h3>
        </div>

        <div class="money-card">
            <p>💎 Total Nilai Jual Persediaan</p>
            <h3>Rp {{ number_format($totalNilaiJual ?? 0, 0, ',', '.') }}</h3>
        </div>
    </section>

</main>

<script>
    // DARK MODE DAN LIGHT MODE

    const html = document.documentElement;
    const themeButton = document.getElementById('themeToggle');

    function getSavedTheme() {
        try {
            return localStorage.getItem('rotasi-stok-theme') || 'light';
        } catch (error) {
            return 'light';
        }
    }

    function applyTheme(theme) {
        html.setAttribute('data-theme', theme);
        themeButton.textContent = theme === 'dark' ? '🌙' : '☀️';

        try {
            localStorage.setItem('rotasi-stok-theme', theme);
        } catch (error) {
            // Tema tetap berjalan meskipun penyimpanan tidak tersedia.
        }

        updateChartTheme();
    }

    themeButton.addEventListener('click', function () {
        const currentTheme = html.getAttribute('data-theme');
        applyTheme(currentTheme === 'dark' ? 'light' : 'dark');
    });

    // DATA DARI DATABASE LARAVEL

    const kategoriLabels = @json($kategoriLabels);
    const kategoriStok = @json($kategoriStok);

    const stokAman = Number(@json($stokAman ?? 0));
    const stokMenipis = Number(@json($stokMenipis ?? 0));

    const chartColors = [
        '#8B72E8', '#48A6E8', '#35C99A', '#F5A65B',
        '#E77BA8', '#6CBAE8', '#B18AE8', '#E6CF62'
    ];

    // PENGATURAN GRAFIK

    let lineChart;
    let doughnutChart;
    let barChart;
    let categoryChart;

    function chartTextColor() {
        return html.getAttribute('data-theme') === 'dark'
            ? '#BFC2D8'
            : '#777991';
    }

    function chartGridColor() {
        return html.getAttribute('data-theme') === 'dark'
            ? 'rgba(255,255,255,.08)'
            : 'rgba(30,30,60,.07)';
    }

    function commonOptions() {
        return {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 1800,
                easing: 'easeOutQuart'
            },
            plugins: {
                legend: {
                    labels: {
                        color: chartTextColor(),
                        usePointStyle: true,
                        boxWidth: 8,
                        padding: 17
                    }
                }
            },
            scales: {
                x: {
                    ticks: { color: chartTextColor() },
                    grid: { color: chartGridColor() }
                },
                y: {
                    beginAtZero: true,
                    ticks: { color: chartTextColor() },
                    grid: { color: chartGridColor() }
                }
            }
        };
    }

    // GRAFIK GARIS

    function createLineChart() {
        const labels = kategoriLabels.length
            ? kategoriLabels
            : ['Belum ada kategori'];

        const values = kategoriStok.length
            ? kategoriStok
            : [0];

        lineChart = new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Stok',
                    data: values,
                    borderColor: '#9278F2',
                    backgroundColor: 'rgba(146,120,242,.15)',
                    borderWidth: 3,
                    fill: true,
                    tension: .45,
                    pointRadius: 5,
                    pointHoverRadius: 8,
                    pointBackgroundColor: '#9278F2'
                }]
            },
            options: commonOptions()
        });
    }

    // DIAGRAM DONAT

    function createDoughnutChart() {
        doughnutChart = new Chart(document.getElementById('doughnutChart'), {
            type: 'doughnut',
            data: {
                labels: ['Stok Aman', 'Stok Menipis'],
                datasets: [{
                    data: [stokAman, stokMenipis],
                    backgroundColor: ['#35C99A', '#F16D91'],
                    borderWidth: 0,
                    hoverOffset: 12
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '69%',
                animation: {
                    animateRotate: true,
                    animateScale: true,
                    duration: 1800
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: chartTextColor(),
                            usePointStyle: true,
                            padding: 18
                        }
                    }
                }
            }
        });
    }

    // GRAFIK BATANG

    function createBarChart() {
        barChart = new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: kategoriLabels.length
                    ? kategoriLabels
                    : ['Belum ada kategori'],
                datasets: [{
                    label: 'Jumlah Stok',
                    data: kategoriStok.length
                        ? kategoriStok
                        : [0],
                    backgroundColor: chartColors,
                    borderRadius: 9,
                    borderSkipped: false
                }]
            },
            options: {
                ...commonOptions(),
                plugins: {
                    legend: { display: false }
                }
            }
        });
    }

    // GRAFIK KATEGORI

    function createCategoryChart() {
        categoryChart = new Chart(document.getElementById('categoryChart'), {
            type: 'polarArea',
            data: {
                labels: kategoriLabels.length
                    ? kategoriLabels
                    : ['Belum ada kategori'],
                datasets: [{
                    data: kategoriStok.length
                        ? kategoriStok
                        : [0],
                    backgroundColor: chartColors,
                    borderWidth: 1,
                    borderColor: html.getAttribute('data-theme') === 'dark'
                        ? '#1c2033'
                        : '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1800,
                    easing: 'easeOutBounce'
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: chartTextColor(),
                            usePointStyle: true,
                            padding: 12
                        }
                    }
                },
                scales: {
                    r: {
                        ticks: { display: false },
                        grid: { color: chartGridColor() }
                    }
                }
            }
        });
    }

    // PERBARUI WARNA GRAFIK SAAT GANTI TEMA

    function updateChartTheme() {
        const charts = [
            lineChart,
            doughnutChart,
            barChart,
            categoryChart
        ];

        charts.forEach(chart => {
            if (!chart) return;

            if (chart.options.plugins?.legend?.labels) {
                chart.options.plugins.legend.labels.color = chartTextColor();
            }

            if (chart.options.scales?.x?.ticks) {
                chart.options.scales.x.ticks.color = chartTextColor();
                chart.options.scales.x.grid.color = chartGridColor();
            }

            if (chart.options.scales?.y?.ticks) {
                chart.options.scales.y.ticks.color = chartTextColor();
                chart.options.scales.y.grid.color = chartGridColor();
            }

            if (chart.options.scales?.r?.grid) {
                chart.options.scales.r.grid.color = chartGridColor();
            }

            chart.update('none');
        });
    }

    // JALANKAN DASHBOARD

    applyTheme(getSavedTheme());

    createLineChart();
    createDoughnutChart();
    createBarChart();
    createCategoryChart();
</script>

</body>
</html>
