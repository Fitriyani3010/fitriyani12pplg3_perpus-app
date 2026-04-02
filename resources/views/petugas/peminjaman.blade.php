<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjaman</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:#e9edf5;
}

/* HEADER */
.header{
    height:80px;
    background:white;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 30px;
    box-shadow:0 4px 10px rgba(0,0,0,0.05);
    position:fixed;
    top:0;
    left:0;
    right:0;
    z-index:1000;
}

.logo{
    display:flex;
    align-items:center;
}

.logo img{
    height:75px;
    margin-right:10px;
}

.toggle-btn{
    font-size:22px;
    cursor:pointer;
}

/* HEADER RIGHT */
.header-right{
    display:flex;
    align-items:center;
    gap:15px;
}

/* FOTO PROFIL */
.profile-top{
    width:45px;
    height:45px;
    border-radius:50%;
    background:#1e3a8a; /* navy */
    display:flex;
    align-items:center;
    justify-content:center;
    overflow:hidden;
    cursor:pointer;
    transition:0.3s;
}

.profile-top:hover{
    transform:translateY(-3px);
    box-shadow:0 8px 15px rgba(0,0,0,0.2);
}

.profile-top img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.initial{
    color:white;
    font-weight:bold;
    font-size:18px;
}

/* LOGOUT BUTTON */
.logout-btn{
    display:flex;
    align-items:center;
    gap:8px;
    background:#dc3545;
    color:white;
    padding:10px 18px;
    border-radius:12px;
    text-decoration:none;
    font-weight:500;
    transition:0.3s;
}

.logout-btn i{
    font-size:14px;
}

.logout-btn:hover{
    background:#b02a37;
    transform:translateY(-3px);
    box-shadow:0 8px 15px rgba(0,0,0,0.2);
}
/* DROPDOWN */
.dropdown{
    position:absolute;
    right:0;
    top:60px;
    background:white;
    width:170px;
    border-radius:10px;
    box-shadow:0 8px 20px rgba(0,0,0,0.1);
    display:none;
    overflow:hidden;
}

.dropdown a{
    display:block;
    padding:12px 15px;
    text-decoration:none;
    color:#333;
    font-size:14px;
    transition:0.2s;
}

.dropdown a:hover{
    background:#f3f4f6;
}

.dropdown a i{
    margin-right:8px;
    color:#5b7bd5;
}

.dropdown.show{
    display:block;
}
/* SIDEBAR */
.sidebar{
    width:230px;
    height:calc(100vh - 80px);
    position:fixed;
    top:80px;
    left:0;
    background:
        linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),
        url('../assets/images/bgsidebarmenu.png');
    background-size:cover;
    padding:20px;
    transition:0.3s;
}

.sidebar.closed{
    width:80px;
}

/* PROFILE */
.profile{
    text-align:center;
    margin-bottom:25px;
    color:white;
}

.avatar{
    width:80px;
    height:80px;
    border-radius:50%;
    background:white;
    color:#4e73df;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:30px;
    font-weight:bold;
    margin:0 auto;
    overflow:hidden;
}

.avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.profile h3{
    margin-top:10px;
    font-size:16px;
}

/* MENU STYLE */
.menu a{
    display:flex;
    align-items:center;
    gap:10px;
    background:rgba(255,255,255,0.85);
    color:#333;
    padding:12px 15px;
    margin:8px 0;
    border-radius:15px;
    text-decoration:none;
    font-weight:500;
    transition:0.3s;
}

.menu a:hover{
    background:white;
    transform:translateX(5px);
    box-shadow:0 6px 12px rgba(0,0,0,0.15);
}

.menu a i{
    width:20px;
    text-align:center;
    color:#5b7bd5;
}

/* ACTIVE MENU */
.menu a.active{
    background:white;
    border-left:5px solid #5b7bd5;
    padding-left:10px;
}

/* CONTENT */
.content{
    margin-left:260px;
    margin-top:80px;
    padding:30px;
}

.sidebar.closed + .content{
    margin-left:80px;
}
.table-box{
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 8px 15px rgba(0,0,0,0.08);
}

table{
    width:100%;
    border-collapse:collapse;
}

table th, table td{
    padding:12px;
    border-bottom:1px solid #eee;
    font-size:14px;
}

table th{
    background:#e3ecff;
    color:#1e3a8a;
}

.kuning{
    color:orange;
    font-weight:bold;
}

.hijau{
    color:green;
    font-weight:bold;
}

.btn{
    padding:6px 12px;
    background:#1e3a8a;
    color:white;
    text-decoration:none;
    border-radius:8px;
    font-size:13px;
}

.btn:hover{
    background:#163072;
}
.filter-box{
    background:white;
    padding:20px;
    border-radius:20px;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
    margin-bottom:20px;
}

/* BARIS ATAS (SEIMBANG) */
.filter-row{
    display:flex;
    gap:10px;
    justify-content:space-between;
    flex-wrap:wrap;
    margin-bottom:15px;
}

.filter-row select,
.filter-row button{
    flex:1;
    min-width:150px;
    padding:8px 12px;
    border-radius:10px;
    border:1px solid #ddd;
}

.filter-row button{
    background:#1e3a8a;
    color:white;
    border:none;
    cursor:pointer;
    transition:0.3s;
}

.filter-row button:hover{
    background:#163072;
}

/* SEARCH DI BAWAH */
.filter-search input{
    width: 98%;
    padding:8px 12px;
    border-radius:10px;
    border:1px solid #ddd;
    outline:none;
    transition:0.3s;
}

.filter-search input:focus{
    border-color:#1e3a8a;
    box-shadow:0 0 5px rgba(30,58,138,0.3);
}

        .btn{
            padding:6px 12px;
            border-radius:8px;
            text-decoration:none;
            font-size:13px;
            color:white;
        }

        .kembali{
            background:#28a745;
        }

        .kembali:hover{
            background:#218838;
        }

        .denda{
            color:#ff6600;
            font-weight:600;
        }
        .terlambat-row{
    background:#fff4f4;
}
    </style>
</head>

<body>

<div class="header">
    <div class="logo">
        <img src="{{ asset('assets/images/logo.png') }}">
        <strong style="color:#1e3a8a;">E-Libra Threeban</strong>
    </div>

    <div class="header-right">

        <!-- PROFILE -->
        <a href="#" style="text-decoration:none;">
            <div class="profile-top">
                @if(!empty($user->foto))
                    <img src="{{ asset('uploads/'.$user->foto) }}">
                @else
                    <div class="initial">
                        {{ strtoupper(substr($username,0,1)) }}
                    </div>
                @endif
            </div>
        </a>

        <!-- LOGOUT -->
        <a href="{{ route('logout') }}" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </a>

    </div>
</div>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="profile">
        <div class="avatar">
            @if(!empty($user->foto))
                <img src="{{ asset('uploads/'.$user->foto) }}">
            @else
                {{ strtoupper(substr($username,0,1)) }}
            @endif
        </div>
        <h3>{{ $username }}</h3>
    </div>

    <div class="menu">
        <a href="{{ route('petugas.dashboard') }}">
            <i class="fas fa-home"></i>Dashboard
        </a>

        <a href="/petugas/buku">
            <i class="fas fa-book"></i>Data Buku
        </a>

        <a href="/petugas/Anggota">
            <i class="fas fa-users"></i>Data Anggota
        </a>

        <a href="/petugas/peminjaman" class="active">
            <i class="fas fa-book-reader"></i>Peminjaman
        </a>

        <a href="/petugas/pengembalian">
            <i class="fas fa-undo"></i>Pengembalian
        </a>

        <a href="/petugas/kategori">
            <i class="fas fa-filter"></i>Manajemen Kategori
        </a>
    </div>

</div>

<!-- CONTENT -->
<div class="content">

    <h2>Data Peminjaman</h2>

    <div class="table-box">

        <!-- FILTER -->
        <div class="filter-box">
            <form method="GET">

                <div class="filter-row">

                    <select name="status_pinjam">
                        <option value="">Semua Status</option>
                        <option value="dipinjam" {{ $status=='dipinjam'?'selected':'' }}>
                            Belum Dikembalikan
                        </option>
                        <option value="terlambat" {{ $status=='terlambat'?'selected':'' }}>
                            Terlambat
                        </option>
                        <option value="menunggu" {{ $status=='menunggu'?'selected':'' }}>
                            Menunggu Konfirmasi
                        </option>
                        <option value="dikembalikan" {{ $status=='dikembalikan'?'selected':'' }}>
                            Sudah Dikembalikan
                        </option>
                    </select>

                    <input type="date" name="dari" value="{{ $dari }}">
                    <input type="date" name="sampai" value="{{ $sampai }}">

                    <button type="submit">
                        Filter
                    </button>

                </div>

                <div class="filter-search">
                    <input type="text" name="search" 
                           placeholder="Cari nama / judul..."
                           value="{{ $search }}">
                </div>

            </form>
        </div>

        <!-- TABEL MASUK KE DALAM BOX -->
        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Buku</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Tenggat</th>
                <th>Tanggal Kembali</th>
                <th>Denda</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            @foreach($data as $i => $row)
            <tr class="{{ (!$row->tgl_pengembalian && $row->tenggat_waktu < date('Y-m-d')) ? 'terlambat-row' : '' }}">

                <td>{{ $i+1 }}</td>
                <td>{{ $row->username }}</td>
                <td>{{ $row->judul }}</td>
                <td>{{ $row->jumlah }}</td>
                <td>{{ $row->tgl_peminjaman }}</td>
                <td>{{ $row->tenggat_waktu }}</td>

                <td>
                    {{ $row->tgl_pengembalian ?? '-' }}
                </td>

                <td class="denda">
                    {{ $row->denda ? 'Rp '.number_format($row->denda) : '-' }}
                </td>

                <td>
                    @if($row->tgl_pengembalian)
                        <span class="hijau">Sudah Dikembalikan</span>
                    @elseif($row->tenggat_waktu < date('Y-m-d'))
                        <span class="kuning">Terlambat</span>
                    @else
                        <span style="color:red">Dipinjam</span>
                    @endif
                </td>

                <td>
                    @if(!$row->tgl_pengembalian)
                        <a href="{{ route('petugas.peminjaman', ['kembalikan'=>$row->id_peminjaman]) }}"
                           onclick="return confirm('Kembalikan buku ini sekarang?')"
                           class="btn kembali">
                           Kembalikan
                        </a>
                    @endif
                </td>

            </tr>
            @endforeach

        </table>

    </div> <!-- PENUTUP table-box -->

</div>
</body>
</html>