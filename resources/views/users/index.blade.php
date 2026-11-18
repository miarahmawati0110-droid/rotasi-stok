
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna | Rotasi Stok Retail</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            background: #f3f6fa;
            color: #27364b;
        }

        .container {
            max-width: 1150px;
            margin: 35px auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 27px;
            margin-bottom: 7px;
        }

        .header p {
            color: #78869a;
            font-size: 14px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0,0,0,.04);
            overflow-x: auto;
        }

        .btn {
            display: inline-block;
            padding: 11px 17px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
        }

        .btn-add {
            background: #2875bd;
            color: white;
        }

        .btn-edit {
            background: #e6f0ff;
            color: #2875bd;
        }

        .btn-delete {
            background: #fff0f0;
            color: #d33b3b;
        }

        .btn-back {
            background: #e9edf3;
            color: #39465a;
        }

        .success, .error {
            padding: 13px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .success {
            background: #e4f7eb;
            color: #237746;
        }

        .error {
            background: #fff0f0;
            color: #b83232;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        th {
            background: #f5f7fb;
            color: #526176;
            text-align: left;
            font-size: 13px;
            padding: 15px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #edf0f5;
            font-size: 14px;
        }

        tr:hover {
            background: #fafcff;
        }

        .user-icon {
            display: inline-flex;
            width: 35px;
            height: 35px;
            background: #e5efff;
            color: #2875bd;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
        }

        .actions {
            display: flex;
            gap: 7px;
            align-items: center;
        }

        .actions form {
            display: inline;
        }

        .pagination {
            margin-top: 20px;
        }

        .bottom {
            margin-top: 22px;
        }

        @media(max-width: 600px) {
            .container {
                margin: 15px auto;
                padding: 12px;
            }

            .card {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <div>
            <h1>Manajemen Pengguna</h1>
            <p>Kelola akun pengguna sistem Rotasi Stok Retail.</p>
        </div>

        <a href="{{ route('users.create') }}" class="btn btn-add">
            + Tambah Pengguna
        </a>
    </div>

    <div class="card">

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Tanggal Terdaftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>
                            {{ $users->firstItem() + $loop->index }}
                        </td>

                        <td>
                            <span class="user-icon">👤</span>
                            {{ $user->name }}
                        </td>

                        <td>{{ $user->username }}</td>

                        <td>{{ $user->email }}</td>

                        <td>
                            {{ $user->created_at?->format('d-m-Y') ?? '-' }}
                        </td>

                        <td>
                            <div class="actions">

                                <a href="{{ route('users.edit', $user->id) }}"
                                   class="btn btn-edit">
                                    Edit
                                </a>

                                @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-delete">
                                            Hapus
                                        </button>
                                    </form>
                                @endif

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:30px;">
                            Belum ada data pengguna.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $users->links() }}
        </div>

        <div class="bottom">
            <a href="{{ route('dashboard') }}" class="btn btn-back">
                ← Kembali ke Dashboard
            </a>
        </div>

    </div>

</div>

</body>
</html>
